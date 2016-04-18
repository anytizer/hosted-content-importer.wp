<?php
class processor_none extends hosted_content_interface
{
	/**
	 * Response when content importer is not defined.
	 *
	 * @param mixed $content_id
	 * @param mixed $section_id
	 *
	 * @return string
	 */
	public function fetch($content_id = null, $section_id = null)
	{
		return "Content importer not defined. Using default: <strong>{$this->method}('{$content_id}', '{$section_id}');</strong>.";
	}
}
