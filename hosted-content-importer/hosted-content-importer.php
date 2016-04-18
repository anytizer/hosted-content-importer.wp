<?php
/*
 * Plugin Name: Hosted Content Importer
 * Plugin URI: https://wordpress.org/plugins/hosted-content-importer/
 * Description: Dynamically fetches programmed contents from third party source
 * Author: Bimal Poudel
 * Author URI: http://bimal.org.np/
 * Development URI: https://github.com/bimalpoudel/hosted-content-importer
 * License: GPLv2 or later
 * Version: 1.0.0
 */

define('HCI_PLUGIN_DIR', dirname(__FILE__));

/**
 * Class file Parsedown.php renamed. Rest, 100% original.
 * http://parsedown.org/
 * https://github.com/erusev/parsedown
 */
if(!class_exists('Parsedown'))
{
	require_once(HCI_PLUGIN_DIR . '/classes/parsedown/class.parsedown.inc.php' );
}

/**
 * Main binder
 */
require_once(HCI_PLUGIN_DIR . '/classes/hci/interface.hosted_content_interface.inc.php');
require_once(HCI_PLUGIN_DIR . '/classes/hci/class.hosted_content_importer.inc.php');

/**
 * List of processors
 */
require_once(HCI_PLUGIN_DIR . '/classes/processors/class.processor_database.inc.php');
require_once(HCI_PLUGIN_DIR . '/classes/processors/class.processor_file.inc.php');
require_once(HCI_PLUGIN_DIR . '/classes/processors/class.processor_markdown.inc.php');
require_once(HCI_PLUGIN_DIR . '/classes/processors/class.processor_none.inc.php');
require_once(HCI_PLUGIN_DIR . '/classes/processors/class.processor_url.inc.php');
require_once(HCI_PLUGIN_DIR . '/classes/processors/class.processor_wikipedia.inc.php');


/**
 * Install WordPress Shortcodes
 */
require_once(HCI_PLUGIN_DIR . '/classes/hci/class.hosted_content_shortcode.inc.php');

new hosted_content_shortcode;
