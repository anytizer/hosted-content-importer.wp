<?php
/*
 * Plugin Name: Hosted Content Importer
 * Plugin URI: https://github.com/bimalpoudel/hosted-content-importer
 * Description: Dynamically fetches programmed contents from third party resource
 * Version: 1.0.0
 * Author: Bimal Poudel
 * Author URI: http://bimal.org.np/
 * License: GPLv2 or later
 */

/**
 * [third import="0"]
 * [third section="0"] - auto calculate: Slug, Post ID, Post Title
 */
class Hosted_Content_Shortcode
{
	public function __construct()
	{
		add_shortcode('third', array($this, 'shortcode'));
		add_action('wp_enqueue_scripts', array($this, 'register_hci_scripts'));
	}

	function shortcode($attributes = array())
	{
		extract(shortcode_atts(array(
			'source' => 'none',
			'id' => '0',
			'section' => '0',
		), $attributes));

		$source = esc_attr($source);
		$id = esc_attr($id);
		$section = esc_attr($section);

		$hci = new Hosted_Content_Importer();
		$remote_content = $hci->process($source, $id, $section);

		$content = sprintf(
			'<div class="third">
				<div class="meta">Source: %s, Import: %s, section: %s</div>
				<div class="remote-content">%s</div>
			</div>',
			$source, $id, $section,
			$remote_content
		);

		return $content;
	}

	function register_hci_scripts()
	{
		wp_register_style('hci', plugins_url('hci.css', __FILE__));
		wp_enqueue_style('hci');
	}
} // close Hosted_Content_Shortcode class.


class Hosted_Content_Importer
{
	public function process($source = '', $import_id = 0, $section_id = 0)
	{
		$method = "hci_" . strtolower($source);
		if (!method_exists($this, $method)) $method = 'hci_none';

		$content = $this->$method($import_id, $section_id);

		return $content;
	}

	/**
	 * @todo Make use of callable functions
	 *
	 * @param $name
	 * @param $arguments
	 *
	 * @return string
	 */
	public function __call($name, $arguments)
	{
		return "Calling object method '$name'(" . implode(', ', $arguments) . ").\n";
	}

	/**
	 * Parse when content importer is not defined.
	 *
	 * @param int $import_id
	 * @param int $section_id
	 *
	 * @return string
	 */
	public function hci_none($import_id = 0, $section_id = 0)
	{
		return "Content importer not defined. Using default: <strong>none({$import_id}, {$section_id})</strong>.";
	}

	/**
	 * @todo Read the real URL
	 *
	 * @param int $import_id
	 * @param int $section_id
	 *
	 * @return string
	 */
	public function hci_url($import_id = 0, $section_id = 0)
	{
		$url = "http://server/serve?import={$import_id}&section={$section_id}";

		return "Reading from URL: {$url}";
	}

	/**
	 * @todo Implement fetching from the database, possibly reuse WordPress connection
	 *
	 * @param int $import_id
	 * @param int $section_id
	 *
	 * @return string
	 */
	public function hci_database($import_id = 0, $section_id = 0)
	{
		return "Reading contents from local DATABASE.";
		# eg. SELECT post_title, guid FROM wp_posts WHERE post_status='publish' ORDER BY ID DESC LIMIT 5;
	}

	/**
	 * @todo Read the Wikipedia sections in JSON format and parse
	 *
	 * @param int $import_id
	 * @param int $section_id
	 *
	 * @return mixed|string
	 */
	public function hci_wikipedia($import_id = 0, $section_id = 0)
	{
		$parameters = array(
			'format' => 'json',
			'action' => 'query', # parse | query
			'prop' => 'extracts',
			'exintro' => '',
			'explaintext' => '',
			'titles' => $import_id,
		);
		$wikipedia_url = 'https://en.wikipedia.org/w/api.php?' . http_build_query($parameters);

		#return file_get_contents($wikipedia_url);
		return $wikipedia_url;

		$ch = curl_init($wikipedia_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, "WordPress HCI Plugin - Hosted Content Importer");
		$content_extracted = curl_exec($ch);
		curl_close($ch);
		$json = json_decode($content_extracted);

		/**
		 * @todo Parse the necessary content
		 */
		$content = print_r($json, true);

		return $content;

		return "Extracting contents from Wikipedia.";
	}
}

new Hosted_Content_Shortcode;
