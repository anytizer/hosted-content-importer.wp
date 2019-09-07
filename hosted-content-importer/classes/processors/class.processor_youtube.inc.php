<?php

/**
 * Embeds a YouTube video
 * [third source="youtube" id="v0000000" section=""]
 * @todo Handle height, width parameters
 */
class processor_youtube extends hosted_content_interface
{
	protected $as_is = true;
	protected $development_completed = true;

	public function fetch($video_id = null, $section_id = null, $others=array())
	{
		$html = '<iframe width="%s" height="%s" src="https://www.youtube.com/embed/%s" allowfullscreen=""></iframe>';

		$width = !empty($others['width'])?(int)$others['width']:560;
		$height = !empty($others['height'])?(int)$others['height']:315;
		
		$html = sprintf($html, $width, $height, esc_attr($video_id));

		return $html;
	}
}
