<?php

/**
 * Reads and parses a remote .md markdown file.
 *
 * Cases: A file may be edited externally on:
 *  - GitHub like servers
 */
class processor_markdown extends hosted_content_interface
{
	protected $as_is = false;
	protected $development_completed = true;

	/**
	 * HTML conversion with Parsedown - reads the .md file and process
	 * @url http://parsedown.org/ | https://github.com/erusev/parsedown
	 *
	 * @param string $content_id
	 * @param string $section_id
	 * @param array $others
	 *
	 * @return string
	 */
	public function fetch($content_id = null, $section_id = null, $others=array())
	{
		$text = $this->fetch_url($content_id);

		$parsedown = new Parsedown();
		$markdown = $parsedown->text($text);

		return $markdown;
	}
}
