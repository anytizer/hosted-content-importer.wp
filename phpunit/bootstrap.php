<?php
error_reporting(E_ALL|E_STRICT);

/**
 * Often XDebug is NOT necessary.
 * @see https://xdebug.org/docs/all_functions
 */
$xdebug_disable = "xdebug_disable";
if(function_exists($xdebug_disable)) {
	$xdebug_disable();
}

function esc_attr($text)
{
    return $text;
}

#require_once "D:/htdocs/wordpress/5.0.1/wp-config.php";

require_once "../hosted-content-importer/classes/hci/interface.hosted_content_interface.inc.php";
require_once "../hosted-content-importer/classes/processors/class.processor_analytics.inc.php";
require_once "../hosted-content-importer/classes/processors/class.processor_code.inc.php";
require_once "../hosted-content-importer/classes/processors/class.processor_file.inc.php";
