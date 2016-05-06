<?php
/**
 * Replication of Gist GitHub Shortcode by Claudio Sanches
 * Original Plugin: https://wordpress.org/plugins/gist-github-shortcode/
 *
 * @todo Seems, this file is automatically deleted by hosting server.
 *
 * Usage Example: [third source="gist" id="000000000" section="file.php"]
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
