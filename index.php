<?php
/*
 * Plugin Name: Hosted Content Importer
 * Plugin URI: https://github.com/bimalpoudel/hosted-content-importer
 * Description: Dynamically fetches programmed contents from third party source
 * Version: 1.0.0
 * Author: Bimal Poudel
 * Author URI: http://bimal.org.np/
 * License: GPLv2 or later
 */

define('HCI_PLUGIN_DIR', dirname(__FILE__));

/**
 * Class file Parsedown.php renamed. Rest, 100% original.
 * http://parsedown.org/
 * https://github.com/erusev/parsedown
 */
require_once( HCI_PLUGIN_DIR . '/classes/class.parsedown.inc.php' );

require_once(HCI_PLUGIN_DIR . '/classes/interface.hosted_content_interface.inc.php');
require_once(HCI_PLUGIN_DIR . '/classes/class.hosted_content_importer.inc.php');
require_once(HCI_PLUGIN_DIR . '/classes/class.hosted_content_shortcode.inc.php');

new hosted_content_shortcode;
