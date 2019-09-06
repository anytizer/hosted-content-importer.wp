<?php

/**
 * Reads a local file on the system.
 * Cases: a file may be:
 *  - Edited over FTP
 *  - Replaced via Dropbox
 *  - symlinked from another user
 */
class processor_file extends hosted_content_interface
{
	protected $as_is = false;
	protected $development_completed = true;

	/**
	 * Import content from local file (eg. PHP include())
	 *
	 * @param string $file_name
	 * @param int $section_id
	 * @param array $others
	 *
	 * @return string
	 */
	public function fetch($file_name = '/tmp/readme.txt', $section_id = 0, $others=array())
	{
		/**
		 * Do NOT use include()/require() methods for safety reasons;
         * Serve the file as is.
         *
         * Do not use it on shared server
		 */

		$content = '';
		if(is_file($file_name))
		{
			$content = file_get_contents($file_name);
		}

		return $content;
	}
}
