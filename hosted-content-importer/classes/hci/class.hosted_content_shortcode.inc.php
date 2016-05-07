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
		
		/**
		 * Reports pages and Menu
		 */
		add_action( 'admin_menu', array($this, 'hci_third_tags_menu'));
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
		
		# We need a boolean value: true | false
		$attributes['cache'] = strtolower($attributes['cache']);
		$attributes['cache'] = ($attributes['cache']==='true' || $attributes['cache']===true);

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

	/**
	 * Reports on which posts and pages used [third] shortcode tags
	 */
	public function hci_third_tags_page()
	{
		wp_enqueue_style('hci-third-tags', plugins_url( 'pages/css/style.css', HCI_PLUGIN_DIR.'/'.basename(HCI_PLUGIN_DIR)));
		
		require_once(HCI_PLUGIN_DIR . '/classes/hci/class.hci_ymdhis.inc.php');
		
		require_once(HCI_PLUGIN_DIR.'/pages/report-tags.php');
		require_once(HCI_PLUGIN_DIR.'/pages/list-caches.php');
	}

	/**
	 * Publishes menu at Pages > With [third] Tags
	 */
	public function hci_third_tags_menu(){
		$icon = 'dashicons-format-aside';
		$myself = basename(dirname(__FILE__)).'/'.basename(__FILE__);
		#add_menu_page('[third] Tags', '[third] Tags', 'manage_options', $myself, array($this, 'hci_third_tags_page'), $icon, 80 );
		add_submenu_page('edit.php', 'Posts/Pages with [third] Tags', 'With [third] Tags', 'manage_options', $myself, array($this, 'hci_third_tags_page'));
	}
}
