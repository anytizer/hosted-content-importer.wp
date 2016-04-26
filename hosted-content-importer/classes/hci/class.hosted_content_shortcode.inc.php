<?php
/**
 * Setup the shortcodes
 */
class hosted_content_shortcode
{
	public function __construct()
	{
		add_shortcode('hci', array($this, '_handle_shortcode'));
		add_shortcode('third', array($this, '_handle_shortcode'));
		
		add_action('wp_enqueue_scripts', array($this, '_register_hci_scripts'));
	}

	public function _handle_shortcode($attributes = array())
	{
		$attributes = array_map('esc_attr', $attributes);
		$standard_attributes = array(
			'source' => 'none',
			'id' => '0', # Integer, URL
			'section' => 'arbitrary',
			'cache' => 'true',
		);
		$attributes = shortcode_atts($standard_attributes, $attributes);
		$attributes['cache'] = (strtolower($attributes['cache'])=='true'); # boolean true | false

		$hci = new hosted_content_importer();
		$remote_content = $hci->process(
			$attributes['source'], 
			$attributes['id'],
			$attributes['section'],
			$attributes['cache']
		);

		/**
		 * @todo The output is likely to be wrapped in <p>...</p> tags.
		 */
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
	
	public function _register_hci_scripts()
	{
		wp_register_style('hci', plugins_url('css/hci.css', realpath(dirname(__FILE__).'/../')));
		wp_enqueue_style('hci');
	}
}
