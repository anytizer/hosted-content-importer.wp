<?php
/**
 * @todo Variables contain mixed type of input data
 */
class hosted_content_importer
{
	/**
	 * @todo Make use of callable functions to handle more HCI snippets
	 *
	 * @param string $name
	 * @param mixed $arguments
	 *
	 * @return string
	 */
	public function __call($name, $arguments)
	{

		return "Calling object method '{$name}'(" . implode(', ', $arguments) . ").";
	}

	/**
	 * @param string $source
	 * @param mixed $content_id
	 * @param mixed $section_id
	 *
	 * @return string
	 */
	public function process($source = '', $content_id = null, $section_id = null)
	{
		$source = preg_replace('/[^a-z0-9]/', '', strtolower($source));
		$processor_name = "processor_{$source}";
		
		if(!class_exists($processor_name))
		{
			trigger_error("Class {$processor_name} not found.", E_USER_NOTICE);
		}
		
		$processor = new $processor_name();
		
		$content = $processor->fetch($content_id, $section_id);

		return $content;
	}
}
