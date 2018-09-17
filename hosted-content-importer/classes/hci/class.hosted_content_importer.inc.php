<?php

final class hosted_content_importer
{
	/**
	 * Send plain text as received, without HTML Wrapping
	 */
	private $as_is = false;

	public function __construct()
	{
		spl_autoload_register(array($this, '_autoload_processors'));
	}
	
	public function as_is()
	{
		return $this->as_is;
	}

	/**
	 * @todo Make use of callable functions to handle more HCI snippets
	 *
	 * @param string $name
	 * @param mixed $arguments
	 *
	 * @return string
	 */
	public function __call($name, $arguments)
	{

		return "Calling object method '{$name}'(" . implode(', ', $arguments) . ").";
	}

	/**
	 * @param string $source
	 * @param mixed $content_id ID or Full URL
	 * @param mixed $section_id
	 * @param boolean $cache_requested
	 *
	 * @todo Process Whole Parameters
	 *
	 * @param array $others Others|Full parameters requested
	 *
	 * @return string
	 */
	public function process($source = '', $content_id = null, $section_id = null, $cache_requested = false, $others = array())
	{
		$source = preg_replace('/[^a-z0-9]/', '', strtolower($source));
		$processor_name = "processor_{$source}";
		if(!class_exists($processor_name))
		{
			trigger_error("Processor class {$processor_name} not found.", E_USER_NOTICE);
		}

		/**
		 * Check for caches
		 */
		$hashed_name = md5("{$source}|{$content_id}|{$section_id}" . implode("#", $others));
		$cache_file = HCI_PLUGIN_DIR . "/caches/{$source}-{$hashed_name}.cache";

		$cache_time = time() - (int)constant('HCI_CACHE_DURATION');

		/**
		 * @todo Follow cache control from parameters
		 * If cache file does not exist
		 * If the cache file is too old
		 */
		$cacheable = true;
		if(!is_file($cache_file))
		{
			$cacheable = false;
		}
		else
		{
			if($cache_requested == true)
			{
				/**
				 * Even if cacheable and cache exists, but old, bring fresh
				 */
				if(filemtime($cache_file) < $cache_time)
				{
					$cacheable = false;
				}
			}
			else
			{
				$cacheable = false;
			}
		}

		$processor = new $processor_name();
		$this->as_is = $processor->as_is();

		if($cacheable != true)
		{
			# Bring the fresh contents
			$content = $processor->fetch($content_id, $section_id, $others);

			# Write the cache file, overwriting filemtime() value
			if(is_file($cache_file))
			{
				unlink($cache_file);
			}
			file_put_contents($cache_file, $content);
		}
		else
		{
			# Read the cached contents
			$content = file_get_contents($cache_file);
		}

		return $content;
	}

	private function _autoload_processors($class_name = '')
	{
        if(file_exists(HCI_PLUGIN_DIR . "/classes/processors/class.{$class_name}.inc.php"))
        {
            $processor = require_once(HCI_PLUGIN_DIR . "/classes/processors/class.{$class_name}.inc.php");
            if(is_file($processor))
            {
                require_once($processor);
            }
        }
	}
}
