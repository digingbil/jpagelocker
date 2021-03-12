<?php
/**
 * @version     1.0.0
 * @package     JPageLocker
 * @copyright   Copyright (C) 2021 Zoran Tanevski. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Zoran Tanevski <zoran@tanevski.com> - http://tanevski.com
 */


defined('JPATH_PLATFORM') or die;

use Joomla\CMS\HTML\HTMLHelper;

class JFormFieldPlgscript extends Joomla\CMS\Form\FormField {

    protected $type = 'plgscript';

    protected function getLabel() {
        return;
    }

    protected function getInput() {

        HTMLHelper::_('script', Juri::root().'/plugins/system/jpagelocker/assets/js/jpagelocker.js', ['version' => 'auto', 'relative' => true]);

        HTMLHelper::_('stylesheet', Juri::root().'/plugins/system/jpagelocker/assets/css/jpagelocker.css', ['version' => 'auto', 'relative' => true]);

        return '';

    }

}