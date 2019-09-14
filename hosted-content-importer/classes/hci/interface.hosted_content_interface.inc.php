<?php

abstract class hosted_content_interface
{
	/**
	 * Send the content as is, without HTML Wrapping
	 */
	protected $as_is = false;

	/**
	 * Determines the status of the processor
	 */
	protected $development_completed = null;

	abstract public function fetch($content_id = null, $section_id = null, $others=array());

	public function as_is()
	{
		return $this->as_is === true;
	}
	
	/**
	 * Determines if the project implementation is finished
	 * @return bool
	 */
	public function completed()
	{
		return $this->development_completed === true;
	}

	/**
	 * Fetch contents from third party server
     * @todo Use anytizer/relay.php via composer
	 *
	 * @param string $url
	 *
	 * @return string
	 */
	protected function fetch_url($url = '')
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); # Do not wait for long
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		/**
		 *  No cache please!
		 */
		curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);

		/**
		 * To allow shortened URLs
		 */
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

		/**
		 * eg. Wikipedia requirements
		 * @see https://www.mediawiki.org/wiki/API:Main_page
		 * @see https://www.mediawiki.org/wiki/API:Etiquette
		 * @see https://meta.wikimedia.org/wiki/User-Agent_policy
		 */
		curl_setopt($ch, CURLOPT_USERAGENT, 'Hosted Content Importer - WP Plugin');

		/**
		 * Mention who is asking
		 * @example http://localhost:80/test/?data=value
		 */
		$http_referer = $this->http_referer();
		curl_setopt($ch, CURLOPT_REFERER, $http_referer);

		$content_extracted = curl_exec($ch);
		curl_close($ch);

		return $content_extracted;
	}

	/**
	 * Build a full URL of the current frontend page
	 * 
	 * @return string Current URL
	 */
	protected function http_referer()
	{
		$scheme = !empty($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'http';
		$port = !empty($_SERVER['SERVER_PORT']) ? $_SERVER['SERVER_PORT'] : 80;
		$uri = !empty($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
		$server = !empty($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'localhost';
		$referer = "{$scheme}://{$server}:{$port}{$uri}";

		return $referer;
	}

	/**
	 * Helper to convert uniformed PHP array data into Basic HTML Table
	 *
	 * @param array $data
	 *
	 * @return string HTML Table Output
	 */
	protected function html_table($data = array())
	{
		$rows = array();
		foreach($data as $row)
		{
			$cells = array();
			foreach($row as $cell)
			{
				$cells[] = "<td>{$cell}</td>";
			}
			$rows[] = "<tr>" . implode('', $cells) . "</tr>";
		}

		return "<table class='hci-table'>" . implode('', $rows) . "</table>";
	}
}
