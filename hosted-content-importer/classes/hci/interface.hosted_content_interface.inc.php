<?php

abstract class hosted_content_interface
{
	private $method = null;
	
	abstract public function fetch($content_id = null, $section_id = null);

	/**
	 * Fetch contents from third party server
	 */
	protected function fetch_url($url='')
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
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
		 */
		curl_setopt($ch, CURLOPT_USERAGENT, 'Hosted Content Importer - WP Plugin');

		$content_extracted = curl_exec($ch);
		curl_close($ch);

		return $content_extracted;
	}

	/**
	 * Helper to convert uniformed PHP array data into Basic HTML Table
	 *
	 * @param array $data
	 *
	 * @return string
	 */
	protected function html_table($data = array(), $heads = array())
	{
		$rows = array();
		foreach ($data as $row) {
			$cells = array();
			foreach ($row as $cell) {
				$cells[] = "<td>{$cell}</td>";
			}
			$rows[] = "<tr>" . implode('', $cells) . "</tr>";
		}

		return "<table class='hci-table'>" . implode('', $rows) . "</table>";
	}
}
