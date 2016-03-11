<?php
class hosted_content_shortcode
{
	public function __construct()
	{
		add_shortcode('third', array($this, 'shortcode'));
		add_action('wp_enqueue_scripts', array($this, 'register_hci_scripts'));
	}

	public function shortcode($attributes = array())
	{
		$attributes = array_map('esc_attr', $attributes);
		$standard_attributes = array(
			'source' => 'none',
			'id' => '0',
			'section' => '0',
		);
		$attributes = shortcode_atts($standard_attributes, $attributes);

		$hci = new hosted_content_importer();
		$remote_content = $hci->process($attributes['source'], $attributes['id'], $attributes['section']);

		$content = sprintf(
			'<div class="hci-third">
				<div class="hci-meta">HCI Data Source: %s, Import: %s, Section: %s</div>
				<div class="hci-remote-content">%s</div>
			</div>',
			$attributes['source'], $attributes['id'], $attributes['section'],
			$remote_content
		);

		return $content;
	}

	public function register_hci_scripts()
	{
		wp_register_style('hci', plugins_url('hci.css', __FILE__));
		wp_enqueue_style('hci');
	}
}
