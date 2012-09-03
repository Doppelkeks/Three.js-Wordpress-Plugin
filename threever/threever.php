<?php
/**
 * @package threever
 * @version 0.1
 */
/*
Plugin Name: threever
Plugin URI: http://threever.com
Description: A plugin for viewing webgl content.
Author: Matthias Guntrum
Version: 0.1
Author URI: http://matthiasguntrum.com
*/

//globals
$hasThree = false;
$threeverId = 0;

//Includes

//Scripts
include('inc/scriptsviewer.inc.php');
include('inc/scriptsadmin.inc.php');

//Mimetypes
include('inc/mimetypes.inc.php');

//adminPanel
include('inc/adminpanel.inc.php');

// TODO: settingsPanel
//include('inc/settingspanel.inc.php');

//ShortcodeHandler
include('inc/shortcodehandler.php');

?>