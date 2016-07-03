<?php

/**
 * Raw Scripts; use CSS to decorate
 *
 * Usage Example: [third source="code" id="http://www.example.com/script.sh" section="file.php"]
 */
class processor_code extends hosted_content_interface
{
	protected $as_is = true;
	protected $development_completed = true;

	public function fetch($code_url = null, $file_name = null, $others=array())
	{
		$code = $this->fetch_url($code_url);
		$html = "<pre>{$code}</pre>";

		return $html;
	}
}
