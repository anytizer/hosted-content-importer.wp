<?php

/**
 * Implementation left for developers
 * A dummy processor - that does nothing at all.
 * Cases: Fail-over on reading processors from source="" parameter.
 */
class processor_none extends hosted_content_interface
{
	protected $development_completed = true;

	/**
	 * Response when content importer is not implemented.
	 *
	 * @param mixed $content_id
	 * @param mixed $section_id
	 *
	 * @return string
	 */
	public function fetch($content_id = null, $section_id = null, $others=array())
	{
		return "Content importer not implemented: fetch('{$content_id}', '{$section_id}');";
	}
}
