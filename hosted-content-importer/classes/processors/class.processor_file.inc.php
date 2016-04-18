<?php
class processor_file extends hosted_content_interface
{
	/**
	 * Import content from local file (eg. PHP include())
	 *
	 * @param mixed $file_name
	 * @param mixed $section_id
	 *
	 * @return string
	 */
	public function fetch($file_name = '/tmp/readme.txt', $section_id = 0)
	{
		/**
		 * Do NOT use include/require for safety reasons
		 */
		
		$content = '';
		if(is_file($file_name))
		{
			$content = file_get_contents($file_name);
		}
		
		return $content;
	}
}
