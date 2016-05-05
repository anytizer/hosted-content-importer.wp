<?php
/**
 * Replication of Gist GitHub Shortcode by Claudio Sanches
 * Original Plugin: https://wordpress.org/plugins/gist-github-shortcode/
 *
 * Usage Example
 * [third source="gist" id="e54d8be8bd9e5e2220389d98af53cbb0" section="PhpIniConfigurationsTest.php"]
 */
class processor_gist extends hosted_content_interface
{
	public function fetch($gist_id = null, $file_name = null)
	{
		$gist = sprintf(
			'<script src="https://gist.github.com/%s.js%s"></script>',
			esc_attr( $gist_id ),
			$file_name ? '?file=' . esc_attr( $file_name ) : ''
		);
		
		return $gist;
	}
}
