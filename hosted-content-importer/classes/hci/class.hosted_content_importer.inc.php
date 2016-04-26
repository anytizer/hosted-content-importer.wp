<?php
class hosted_content_importer
{
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
	 * @return string
	 */
	public function process($source = '', $content_id = null, $section_id = null, $cache_requested = false)
	{
		print_r(func_get_args());
		
		$source = preg_replace('/[^a-z0-9]/', '', strtolower($source));
		$processor_name = "processor_{$source}";
		if(!class_exists($processor_name))
		{
			trigger_error("Processor class {$processor_name} not found.", E_USER_NOTICE);
		}
		
		/**
		* Check for caches
		*/
		$hashed_name = md5("{$source}|{$content_id}|{$section_id}");
		$cache_file = HCI_PLUGIN_DIR."/caches/{$source}/{$hashed_name}.cache";
		
		/**
		 * @todo Configure the total durations at user level: Hour + Minute + Seconds
		 */
		$cache_hours   = 5; # 0 - 23
		$cache_minutes = 0; # 0 - 59
		$cache_seconds = 0; # 0 - 59
		$cache_duration = $cache_hours * 60 * 60 + $cache_minutes * 60 + $cache_seconds;
		$cache_time = time() - $cache_duration;
		
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
			if($cache_requested==true)
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
		 
		if($cacheable != true)
		{
			# Bring the fresh contents
			$processor = new $processor_name();
			$content = $processor->fetch($content_id, $section_id);
			
			# And write the cache file, overwrites filemtime() value
			file_put_contents($cache_file, $content);
		}
		else
		{
			# Read the cached contents
			$content = file_get_contents($cache_file);
		}

		return $content;
	}
}
