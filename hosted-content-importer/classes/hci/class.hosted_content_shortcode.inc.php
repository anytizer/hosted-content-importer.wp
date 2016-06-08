<?php

/**
 * Setup the shortcodes
 */
final class hosted_content_shortcode
{
	public function __construct()
	{
		add_shortcode('hci', array($this, '_handle_shortcode'));
		add_shortcode('third', array($this, '_handle_third_shortcode'));

		add_action('wp_enqueue_scripts', array($this, '_register_hci_scripts'));

		/**
		 * Reports pages and Menu
		 */
		$plugin_host_file=basename(HCI_PLUGIN_DIR).'/'.basename(HCI_PLUGIN_DIR).'.php';
		add_action('admin_menu', array($this, '_hci_third_tags_menu'));
		add_filter("plugin_action_links_{$plugin_host_file}", array($this, '_add_reports_links'));
		
		/**
		 * Quick Tags in HTML Text Editor Mode
		 */
		add_action('admin_print_footer_scripts', array($this, '_add_quick_tags'));
		add_action('init', array($this, '_js_buttons_init'));
		//add_action( 'hci_js_editor', array( $this, '_js_dialog' ) );
	}

	/**
	 * @param array $attributes
	 *
	 * @return string
	 */
	public function _handle_third_shortcode($attributes = array())
	{
		/**
		 * To tolerate bare usage, without parameters
		 */
		if(!is_array($attributes)) $attributes = array();

		$attributes = array_map('esc_attr', $attributes);
		$standard_attributes = array(
			# Standard Parameters
			'source' => 'none',
			'id' => '0', # Integer, URL, File Name
			'section' => 'arbitrary',
			'cache' => 'true',
			
			# Others, plus anyting that user typed in
			'age' => HCI_CACHE_DURATION, # 5*60*60, # @todo Custom cache age
			'permanent' => 'false', # @todo permanent cache
			'width' => '560', # @todo eg. YouTube, QR
			'height' => '315', # @todo eg. YouTube, QR
		);
		$attributes = shortcode_atts($standard_attributes, $attributes);

		# We need a boolean value: true | false
		$attributes['cache'] = strtolower($attributes['cache']);
		$attributes['cache'] = ($attributes['cache'] === 'true' || $attributes['cache'] === true);

		$others = $attributes;
		unset($others['source']);
		unset($others['id']);
		unset($others['section']);
		unset($others['cache']);
		
		$hci = new hosted_content_importer();
		$remote_content = $hci->process($attributes['source'], $attributes['id'], $attributes['section'], $attributes['cache'], $attributes);

		/**
		 * @todo The output is likely to be wrapped in <p>...</p> tags.
		 * Some contents may require special DIV wrapping for decoration purpose
		 */
		if(!$hci->as_is())
		{
			$remote_content = sprintf('
<div class="hci-third">
	<div class="hci-meta">HCI Data Source: %s, Import: %s, Section: %s</div>
	<div class="hci-remote-content">%s</div>
</div>', $attributes['source'], $attributes['id'], $attributes['section'], $remote_content);
		}
		
		return $remote_content;
	}
	
	/**
	 * @see https://codex.wordpress.org/Quicktags_API
	 */
	public function _add_quick_tags()
	{
		if (wp_script_is('quicktags')){
		?>
		<script type="text/javascript">
		QTags.addButton('third-hci-template', '[third]', '\r\n[third source="markdown" id="" section=""]\r\n', null, null, 'HCI [third] Tag', 9990, null);
		QTags.addButton('third-hci-qr', '[QR]', '\r\n[third source="qr" id="url" section="internal"]\r\n', null, null, 'HCI [QR] Tag', 9991, null);
		QTags.addButton('third-hci-yt', '[YT]', '\r\n[third source="youtube" id="v00000000" section=""]\r\n', null, null, 'HCI [YouTube] Tag', 9992, null);
		</script>
		<?php
		}
	}

	/**
	 * CSS for front end
	 */
	public function _register_hci_scripts()
	{
		wp_register_style('hci', plugins_url('css/hci.css', realpath(dirname(__FILE__) . '/../')));
		wp_enqueue_style('hci');
	}

	/**
	 * Reports on which posts and pages used [third] shortcode tags
	 */
	public function _hci_third_tags_page()
	{
		wp_enqueue_style('hci-third-tags', plugins_url('pages/css/style.css', HCI_PLUGIN_DIR . '/' . basename(HCI_PLUGIN_DIR)));

		require_once(HCI_PLUGIN_DIR . '/classes/hci/class.hci_ymdhis.inc.php');

		#require_once(HCI_PLUGIN_DIR . '/pages/tabs.php');

		/**
		 * Reports on which posts or page use [third] tags
		 */
		require_once(HCI_PLUGIN_DIR . '/pages/report-tags.php');

		/**
		 * Reports on cached files
		 */
		require_once(HCI_PLUGIN_DIR . '/pages/list-caches.php');

		/**
		 * List of available Content Processors
		 */
		require_once(HCI_PLUGIN_DIR . '/pages/list-processors.php');
		
		require_once(HCI_PLUGIN_DIR . '/pages/report-shortcodes.php');
	}

	/**
	 * Adds reports menu in plugin source
	 *
	 * @param $links
	 *
	 * @return array
	 */
	function _add_reports_links($links)
	{
		$actions = array();
		$actions[] = "<a id='hci-reports' href='edit.php?page=hci/class.hosted_content_shortcode.inc.php'>Reports</a>";

		$links = array_merge($actions, $links);
		return $links;
	}

	/**
	 * Publishes menu at Pages > With [third] Tags
	 */
	public function _hci_third_tags_menu()
	{
		$myself = basename(dirname(__FILE__)) . '/' . basename(__FILE__);
		add_submenu_page('edit.php', 'Posts/Pages with [third] Tags', 'With [third] Tags', 'manage_options', $myself, array($this, '_hci_third_tags_page'));
	}

	/**
	 * Add custom buttons in TinyMCE.
	 *
	 * @param $buttons
	 *
	 * @return mixed
	 */
	function _register_js_buttons( $buttons ) {
		array_push( $buttons, 'separator', 'third' );
		return $buttons;
	}

	/**
	 * Register button scripts.
	 *
	 * @param $plugin_array
	 *
	 * @return mixed
	 */
	function _add_external_plugins( $plugin_array ) {
		$plugin_array['third'] = plugins_url('tinymce/third.js' , dirname(dirname(__FILE__)));
		return $plugin_array;
	}

	/**
	 * Register buttons in init.
	 */
	function _js_buttons_init() {
		if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
			return;
		}

		if ( true == get_user_option( 'rich_editing') )
		{
			add_filter( 'mce_buttons', array( $this, '_register_js_buttons' ) );
			add_filter( 'mce_external_plugins', array( $this, '_add_external_plugins' ) );
		}
	}
}
