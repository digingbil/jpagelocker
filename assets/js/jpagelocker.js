/**
 * @version     1.0.0
 * @package     JPageLocker
 * @copyright   Copyright (C) 2021 Zoran Tanevski. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Zoran Tanevski <zoran@tanevski.com> - http://tanevski.com
 */
(() => {
    document.addEventListener('DOMContentLoaded', () => {

       const passwordField = document.querySelector('#jform_params_locking_password');
       const passtoggle = document.querySelector('.pass-toggle');

        if( passwordField && passtoggle ) {

            passtoggle.addEventListener('click', () => {

                let pass_is_textfield = passwordField.getAttribute('type') == 'text';

                if( pass_is_textfield ) {
                    passwordField.setAttribute('type', 'password') ;
                } else {
                    passwordField.setAttribute('type','text');
                }

            });
            
        }

    });
})()