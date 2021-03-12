<?php
/**
 * @version     1.0.0
 * @package     JPageLocker
 * @copyright   Copyright (C) 2021 Zoran Tanevski. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Zoran Tanevski <zoran@tanevski.com> - http://tanevski.com
 */


defined('JPATH_PLATFORM') or die;

JFormHelper::loadFieldClass('password');

class JFormFieldPassfieldwithtoggler extends JFormFieldPassword {

    protected $type = 'Passfieldwithtoggler';

    protected function getInput() {

        return parent::getInput().'<span class="pass-toggle" title="Toggle visibility"></span>';

    }

}