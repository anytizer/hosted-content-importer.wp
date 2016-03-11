<?php
/**
 * Class hosted_content_importer
 * @todo Variables will content mixed data input
 */
class hosted_content_importer implements hosted_content_interface
{
	private $method = null;

	/**
	 * @todo Make use of callable functions to handle more HCI snippets
	 *
	 * @param $name
	 * @param $arguments
	 *
	 * @return string
	 */
	public function __call($name, $arguments)
	{

		return "Calling object method '{$name}'(" . implode(', ', $arguments) . ").";
	}

	public function process($source = '', $content_id = 0, $section_id = 0)
	{
		$this->method = "hci_" . strtolower($source);
		if (!method_exists($this, $this->method)) $this->method = 'hci_none';

		$content = $this->{$this->method}($content_id, $section_id);

		return $content;
	}

	/**
	 * PHP Array to Basic HTML Table
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
	 * Response when content importer is not defined.
	 *
	 * @param int $content_id
	 * @param int $section_id
	 *
	 * @return string
	 */
	private function hci_none($content_id = 0, $section_id = 0)
	{
		return "Content importer not defined. Using default: <strong>{$this->method}('{$content_id}', '{$section_id}');</strong>.";
	}

	/**
	 * Import content from local file (eg. PHP include())
	 *
	 * @param int $content_id
	 * @param int $section_id
	 *
	 * @return string
	 */
	private function hci_file($content_id = 0, $section_id = 0)
	{
		return "Content importer local file not defined. <strong>{$this->method}({$content_id}, {$section_id})</strong>.";
	}

	/**
	 * @todo Import content from an URL (remote file)
	 *
	 * @param int $content_id
	 * @param int $section_id
	 *
	 * @return string
	 */
	private function hci_url($content_id = 0, $section_id = 0)
	{
		$parameters = array(
			'id' => $content_id,
			'section' => $section_id,
		);
		/**
		 * @todo Remove hard coded URLs
		 */
		$api_url = HCI_CUSTOM_API_URL . '?' . http_build_query($parameters);
		$json = file_get_contents($api_url);
		$data = json_decode($json, true);
		$html_table = $this->html_table($data);

		return $html_table;
	}

	/**
	 * Fetch content from the database, (possibly) reusing WordPress's existing connection
	 *
	 * @param int $content_id
	 * @param int $section_id
	 *
	 * @return string
	 */
	private function hci_database($content_id = 0, $section_id = 0)
	{
		global $wpdb;

		$html = 'Reading contents from local DATABASE.';
		switch ($section_id) {
			case 'latest':
			case 'recent':
				$rows = $wpdb->get_results("SELECT post_title, guid FROM {$wpdb->prefix}posts WHERE post_type='post' AND post_status='publish' ORDER BY ID DESC LIMIT 5;");
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
	 * Reads the .md file file and process
	 * @url https://en.support.wordpress.com/markdown/
	 *
	 * @param int $content_id
	 * @param int $section_id
	 *
	 * @return mixed|string
	 */
	private function hci_markdown($content_id = 0, $section_id = 0)
	{
		$options = array(
			'http' => array(
				'method' => 'GET',
				'header' => array(
					'Accept-Language: en',
				),
			));
		$context = stream_context_create($options);
		$markdown = file_get_contents($content_id, false, $context);

		/**
		 * @todo Render markdown
		 * $markdown = markdown($markdown);
		 */

		return $markdown;
	}

	/**
	 * @todo Read the Wikipedia sections in JSON format and parse
	 *
	 * @param int $content_id
	 * @param int $section_id
	 *
	 * @return mixed|string
	 */

	private function hci_wikipedia($content_id = 0, $section_id = 0)
	{
		$parameters = array(
			'format' => 'json',
			'action' => 'query', # parse | query
			'prop' => 'extracts',
			'exintro' => '',
			'explaintext' => '',
			'titles' => $content_id,
		);
		$wikipedia_url = HCI_WIKIPEDIA_API_URL . '?' . http_build_query($parameters);

		return "View Source: <a href='{$wikipedia_url}'>{$wikipedia_url}</a>";

		/**
		 * @todo Correctly parse and render particular Wikipedia section
		 */
		$ch = curl_init($wikipedia_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, 'WordPress HCI Plugin - Hosted Content Importer');
		$content_extracted = curl_exec($ch);
		curl_close($ch);
		$json = json_decode($content_extracted);
		$content = print_r($json, true);

		return $content;
	}
}
