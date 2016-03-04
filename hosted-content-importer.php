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
 * [third self="0"] - auto calculate: Slug, Post ID, Post Title
 */
class Hosted_Content_Shortcode
{

	/**
	 * Class construct.
	 */
	public function __construct()
	{
		// Register the shortcode.
		add_shortcode('third', array($this, 'shortcode'));

		add_action('wp_enqueue_scripts', array($this, 'register_hci_scripts'));
	}

	/**
	 * @todo put ID or URL of the current post
	 */
	function shortcode($atts)
	{
		extract(shortcode_atts(array(
			'source' => 'none',
			'id' => '0',
			'self' => '0',
		), $atts));

		$source = esc_attr($source);
		$id = esc_attr($id);
		$self = esc_attr($self);

		$hci = new Hosted_Content_Importer();
		$remote_content = $hci->fetch($source, $id, $self);

		$content = sprintf(
			'<div class="third">
				<div class="meta">Source: %s, Import: %s, Self: %s</div>
				<div class="remote-content">%s</div>
			</div>',
			$source, $id, $self,
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
	public function fetch($source = '', $import_id = 0, $self_id = 0)
	{
		$method = "hci_" . strtolower($source);
		if (!method_exists($this, $method)) $method = 'hci_none';

		$content = $this->$method($import_id, $self_id);

		return $content;
	}

	public function hci_none($import_id = 0, $self_id = 0)
	{
		return "No remote content reader handler. <strong>({$import_id}, {$self_id})</strong>.";
	}

	public function hci_url($import_id = 0, $self_id = 0)
	{
		return "Reading contents from URL.";
	}

	public function hci_database($import_id = 0, $self_id = 0)
	{
		return "Reading contents from local DATABASE.";
		# SELECT post_title, guid FROM wp_posts WHERE post_status='publish' ORDER BY ID DESC LIMIT 5;
	}

	public function hci_wikipedia($import_id = 0, $self_id = 0)
	{
		return "Extracting contents from Wikipedia.";
	}
}

new Hosted_Content_Shortcode;
