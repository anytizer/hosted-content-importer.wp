<?php
/**
 * Class hosted_content_importer
 * @todo Variables will content mixed data input
 */
class hosted_content_importer implements hosted_content_interface
{
	private $method = null;

	/**
	 * Fetch contents from third party server
	 */
	private function fetch_url($url='')
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); # To allow shortened URLs
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
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
	private function html_table($data = array(), $heads = array())
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
		$this->method = "hci_" . strtolower($source);
		if (!method_exists($this, $this->method))
		{
			$this->method = 'hci_none';
		}

		$content = $this->{$this->method}($content_id, $section_id);

		return $content;
	}

	/**
	 * Response when content importer is not defined.
	 *
	 * @param mixed $content_id
	 * @param mixed $section_id
	 *
	 * @return string
	 */
	private function hci_none($content_id = null, $section_id = null)
	{
		return "Content importer not defined. Using default: <strong>{$this->method}('{$content_id}', '{$section_id}');</strong>.";
	}

	/**
	 * Import content from local file (eg. PHP include())
	 *
	 * @param mixed $content_id
	 * @param mixed $section_id
	 *
	 * @return string
	 */
	private function hci_file($content_id = 0, $section_id = 0)
	{
		return "Content importer local file not defined. <strong>{$this->method}({$content_id}, {$section_id})</strong>.";
	}

	/**
	 * @todo Import content from a URL (remote file)
	 *
	 * @param mixed $content_id
	 * @param mixed $section_id
	 *
	 * @return string
	 */
	private function hci_url($content_id = null, $section_id = null)
	{
		$parameters = array(
			'id' => $content_id,
			'section' => $section_id,
		);
		/**
		 * @todo Remove hard coded custom URLs
		 */
		$api_url = constant('HCI_CUSTOM_API_URL') . '?' . http_build_query($parameters);
		$json = $this->fetch_url($api_url);
		$data = json_decode($json, true);
		$html_table = $this->html_table($data);

		return $html_table;
	}

	/**
	 * Fetch content from the database, (possibly) reusing WordPress's existing connection
	 *
	 * @param mixed $content_id
	 * @param mixed $section_id
	 *
	 * @return string
	 */
	private function hci_database($content_id = null, $section_id = null)
	{
		global $wpdb;

		$html = 'Reading contents from local DATABASE.';
		switch ($section_id) {
			case 'latest':
			case 'recent':
				$rows = $wpdb->get_results("SELECT post_title, guid FROM {$wpdb->prefix}posts WHERE post_type='post' AND post_status='publish' ORDER BY ID DESC LIMIT 20;");
				$li = array();
				foreach ($rows as $row) {
					$li[] = "<li><a href='{$row->guid}'>{$row->post_title}</a></li>";
				}

				$html = '<ul>' . implode('', $li) . '</ul>';
				break;
			default:
				$html = "Database fetcher not handled for this section: #{$section_id}";
		}

		return $html;
	}

	/**
	 * @todo Read the Wikipedia sections in JSON format and parse | Unfinished work
	 *
	 * @param mixed $content_id
	 * @param mixed $section_id
	 *
	 * @return string
	 */
	private function hci_wikipedia($content_id = null, $section_id = null)
	{
		$parameters = array(
			'format' => 'json',
			'action' => 'query', # parse | query
			'prop' => 'extracts',
			'exintro' => '',
			'explaintext' => '',
			'titles' => $content_id,
		);
		$wikipedia_url = constant('HCI_WIKIPEDIA_API_URL') . '?' . http_build_query($parameters);

		return "View Source: <a href='{$wikipedia_url}'>{$wikipedia_url}</a>";

		/**
		 * @todo Correctly parse and render particular Wikipedia section
		 */
		$content_extracted = $this->fetch_url($wikipedia_url);
		$json = json_decode($content_extracted);
		$content = print_r($json, true);

		return $content;
	}

	/**
	 * HTML conversion with Parsedown - reads the .md file and process
	 * @url http://parsedown.org/ | https://github.com/erusev/parsedown
	 *
	 * @param mixed $content_id
	 * @param mixed $section_id
	 *
	 * @return string
	 */
	private function hci_markdown($content_id = null, $section_id = null)
	{
		$text = $this->fetch_url($content_id);

		$parsedown = new Parsedown();
		$markdown = $parsedown->text($text);

		return $markdown;
	}
}
