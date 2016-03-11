<?php
/*
 * Plugin Name: Hosted Content Importer
 * Plugin URI: https://github.com/bimalpoudel/hosted-content-importer
 * Description: Dynamically fetches programmed contents from third party resource
 * Version: 1.0.0
 * Author: Bimal Poudel
 * Author URI: http://bimal.org.np/
 * License: GPLv2 or later
 */

define('HCI_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
require_once(HCI_PLUGIN_DIR.'/interface.hosted_content_interface.inc.php');
require_once(HCI_PLUGIN_DIR.'/class.hosted_content_importer.inc.php');
require_once(HCI_PLUGIN_DIR.'/class.hosted_content_shortcode.inc.php');

new hosted_content_shortcode;
