<?php
/**
 * Plugin Name: Hosted Content Importer (HCI)
 * Plugin URI: https://wordpress.org/plugins/hosted-content-importer/
 * Description: Embeds third party contents. Usage: <code>[third source="markdown" id="URL" section=""]</code>
 * Author: Bimal Poudel
 * Author URI: http://bimal.org.np/
 * Development URI: https://github.com/bimalpoudel/hosted-content-importer/
 * License: GPLv2 or later
 * Version: 3.0.1
 */

/**
 * Cached file validity duration: seconds(Hour+Minutes+Seconds)
 */
define('HCI_CACHE_DURATION', 5 * 60 * 60 + 0 * 60 + 0);

/**
 * Do NOT edit
 */
define('HCI_PLUGIN_DIR', dirname(__FILE__));

/**
 * http://parsedown.org/
 * https://github.com/erusev/parsedown
 */
if(!class_exists('Parsedown'))
{
	require_once(HCI_PLUGIN_DIR . '/classes/parsedown/Parsedown.php');
}

/**
 * Main binder
 */
require_once(HCI_PLUGIN_DIR . '/classes/hci/interface.hosted_content_interface.inc.php');
require_once(HCI_PLUGIN_DIR . '/classes/hci/class.hosted_content_importer.inc.php');

/**
 * Install WordPress Shortcodes Handler
 * Install report page
 * Install menus
 */
require_once(HCI_PLUGIN_DIR . '/classes/hci/class.hosted_content_shortcode.inc.php');
new hosted_content_shortcode();
