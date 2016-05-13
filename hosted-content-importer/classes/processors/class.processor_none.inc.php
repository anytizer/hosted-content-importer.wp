<?php

/**
 * Implementation left for developers
 * A dummy processor - that does nothing at all.
 * Cases: Fail-over on reading processors from source="" parameter.
 */
class processor_none extends hosted_content_interface
{
	protected $as_is = false;
	protected $development_completed = true;

	/**
	 * Response when content importer is not implemented.
	 *
	 * @param null $content_id
	 * @param null $section_id
	 * @param array $others
	 *
	 * @return string
	 */
	public function fetch($content_id = null, $section_id = null, $others=array())
	{
		return "Content importer not implemented: fetch('{$content_id}', '{$section_id}');";
	}
}
