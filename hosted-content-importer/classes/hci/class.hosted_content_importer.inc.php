<?php
/**
 * @todo Variables contain mixed type of input data
 */
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
	 * @param mixed $content_id
	 * @param mixed $section_id
	 *
	 * @return string
	 */
	public function process($source = '', $content_id = null, $section_id = null)
	{
		$source = preg_replace('/[^a-z0-9]/', '', strtolower($source));
		$processor_name = "processor_{$source}";
		
		/**
		* Check for caches
		*/
		$hash = md5("{$source}|{$content_id}|{$section_id}");
		$cache_file = HCI_PLUGIN_DIR."/caches/{$source}/{$hash}.cache";
		$cache_hours = 0; # 0-23
		$cache_minutes = 2; # 0 - 59
		$cache_seconds = 0; # 0 - 59
		$cache_duration = $cache_hours * 60 * 60 + $cache_minutes * 60 + $cache_seconds; # Hour Minute Seconds
		$cache_time = time() - $cache_duration;
		
		if(!is_file($cache_file) || filemtime($cache_file) < $cache_time)
		{
			# Bring the contents
			# Write the file
			if(!class_exists($processor_name))
			{
				trigger_error("Class {$processor_name} not found.", E_USER_NOTICE);
			}
			
			$processor = new $processor_name();
			$content = $processor->fetch($content_id, $section_id);
			
			# Should overwrite filemtime() value
			file_put_contents($cache_file, $content);
		}
		else
		{
			# Read the cache
			$content = file_get_contents($cache_file);
		}
		
		/**
		$now = time();
		$filemtime = filemtime($cache_file);
		$diff = $now - $filemtime;
		return "Now: {$now} - filemtime: {$filemtime} = {$diff} | Needed = {$cache_duration}" . $content;
		*/
		return $content;
	}
}
