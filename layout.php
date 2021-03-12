<?php
/**
 * @version     1.0.0
 * @package     JPageLocker
 * @copyright   Copyright (C) 2021 Zoran Tanevski. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Zoran Tanevski <zoran@tanevski.com> - http://tanevski.com
 */

defined('_JEXEC') or die;

?><!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $params->get('page_title','Restricted access!'); ?></title>
            <style>
                *{
                    padding:0;
                    margin:0;
                    box-sizing: border-box;
                }
                html {
                    height: 100%;
                }
                body {
                    font-family: <?php echo $params->get('font_family','Helvetica, Arial, sans-serif'); ?>;
                    font-size: <?php echo $params->get('font_size',16); ?>px;
                    line-height: 1.3;
                    min-height: 100%;
                    background-color: <?php echo $params->get('background_color','#ff4342'); ?>;
                    padding-top: 40px;
                    color: <?php echo $params->get('text_color','#141414'); ?>;
                }
                .restricted-form{
                    max-width: 500px;
                    width: 90%;
                    padding: 30px;
                    background: #fff;
                    margin:0 auto;
                    box-shadow: 0 0 6px 0 rgba(0,0,0,.6);
                    border-radius: 1.5px;
                }
                h1{
                    margin-top: 0;
                    margin-bottom: 30px;
                    font-size: 30px;                }
                form{
                    display: block;
                    position: relative;
                }
                form .form-row {
                    margin-bottom: 15px;
                }
                form label {
                    display: block;
                    margin-bottom: 10px;
                }
                form input[type=password] {
                    display: block;
                    width: 100%;
                    padding: 5px 10px;
                }
                form button {
                    display: inline-block;
                    padding: 10px 20px;
                    background: <?php echo $params->get('submit_button_background','#7e2121'); ?>;
                    border: none;
                    color: #fff;
                    font-weight: bold;
                    cursor: pointer;
                }
            </style>
    </head>
    <body>
        <div class="restricted-form">
            <h1><?php echo $params->get('page_title','Restricted access!'); ?></h1>
            <form action="" method="post">
                <div class="form-row">
                    <input type="password" name="restrict_password" id="the_pass" placeholder="Password:">
                </div>
                <div class="form-row">
                    <button type="submit"><?php echo $params->get('submit_button_text','Submit'); ?></button>
                    <input type="hidden" name="__jpagelocker_sbmt" value="">
                </div>
            </form>
        </div>
    </body>
</html><?php 