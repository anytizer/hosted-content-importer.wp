<?php

/**
 * Embeds a YouTube video
 * [third source="youtube" id="v0000000" section=""]
 * @todo Handle height, width parameters
 */
class processor_youtube extends hosted_content_interface
{
	public function fetch($video_id = null, $section_id = null)
	{
		$html = '<iframe width="%s" height="%s" src="https://www.youtube.com/embed/%s" frameborder="0" allowfullscreen></iframe>';
		$html = sprintf($html, 560, 315, esc_attr($video_id));
		return $html;
	}
}
