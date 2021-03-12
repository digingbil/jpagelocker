<?php 
/**
 * @version     1.0.0
 * @package     JPageLocker
 * @copyright   Copyright (C) 2021 Zoran Tanevski. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Zoran Tanevski <zoran@tanevski.com> - http://tanevski.com
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

class PlgSystemJpagelocker extends JPlugin {

    const SESSION_KEY_NAME = '__jpagelocker_key';

    protected $autoloadLanguage = true;
    protected $app;

    public function __construct( &$subject, $config ){

        parent::__construct($subject, $config);

    }
    
    /**
     * Hook on onAfterRoute
     */
    public function onAfterRoute() {

        if ( $this->app->isClient('administrator') ) {
            return;
        }

        $jinput = $this->app->input;
        $session = Factory::getSession();
        $current_url = JUri::getInstance()->toString();

        $request_data = [
            'option' => $jinput->getCmd( 'option', '' ),
            'view' => $jinput->getString( 'view', '' ),
            'layout' => $jinput->getString( 'layout', '' ),
            'task' => $jinput->get( 'task', '' ),
            'id' => $jinput->getInt( 'id', 0 ),
            'Itemid' => $jinput->getInt( 'Itemid', 0 ),
            'language' => $jinput->getString( 'language','en-GB' )
        ];

        $stored_pass = trim( $this->params->get('locking_password', '') );

        if( $this->isRestricted($request_data) ) {

            // OK, We are on a restricted page.

            // Check if there is a form POST submit
            if( isset($_POST['__jpagelocker_sbmt']) ) {

                $pass_submitted = trim( $jinput->get('restrict_password','','RAW') );

                if( empty($pass_submitted) ) {
                    //Show locked page!
                    echo $this->generateForm();
                    exit;
                }

                if( $pass_submitted ===  $stored_pass ) {
                    //Ok bingo!

                    $pass_hash = password_hash( $pass_submitted, PASSWORD_DEFAULT );

                    //Save hash to session
                    $session->set( self::SESSION_KEY_NAME, $pass_hash );

                    //Unset submit
                    $jinput->set( '__jpagelocker_sbmt', null );
                    
                    //Redirect to the "unlocked" page
                    $this->app->redirect( $current_url );
                    exit;

                }


            }

            //Well, show the locked page now.
            if(! $this->isAuthenticated( $stored_pass ) ) {
                echo $this->generateForm();
                exit;
            }


        }
        
    }

    /**
     * Check if we are on a restricted page
     * TODO: Expand the restriction options to more than menu items.
     */
    public function isRestricted( $request_data ) {
        
        $menu_items_to_restrict = $this->params->get('locked_items', null);

        if(is_array($menu_items_to_restrict)){
            $menu_items = array_map( function($value) { return (int)$value; }, $menu_items_to_restrict );
        }

        if( 
            !empty( $menu_items ) && 
            in_array( $request_data['Itemid'], $menu_items )
        ) {
            return true;
        }

        return false;
    }

    /**
     * Check session for auth token
     */
    public function isAuthenticated($stored_pass) {
        
        if(! empty($stored_pass) ) {

            $jinput = $this->app->input;

            //Check Session first
            $session = Factory::getSession();
            $session_pass = $session->get( self::SESSION_KEY_NAME, '' );

            if( !empty($session_pass) ) {

                if( password_verify( $stored_pass, $session_pass ) ) {
                    return true;
                }

            }

        }

        return false;
    }
    
    /**
     * Render the form page and clear buffer
     */
    public function generateForm() {

        $html = 'Restricted page!';
        $layout_file = JPATH_ROOT.'/plugins/system/jpagelocker/layout.php';

        ob_start();

        if( file_exists($layout_file) ) {

            $params = $this->params;
            include_once( $layout_file );
            
        } else {

            echo $html;

        }   

        return ob_get_clean();
    }
    
}
