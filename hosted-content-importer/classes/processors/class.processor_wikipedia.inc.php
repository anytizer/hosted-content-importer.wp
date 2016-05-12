<?php

/**
 * Class processor_wikipedia
 * Implementation left for developers
 * Cases: To draw one small section of a huge article on Wikipedia like servers.
 */
class processor_wikipedia extends hosted_content_interface
{
	protected $development_completed = false;

	/**
	 * @todo Read the Wikipedia sections in JSON format and parse | Unfinished work
	 *
	 * @param null $content_id
	 * @param null $section_id
	 * @param array $others
	 *
	 * @return mixed|string
	 */
	public function fetch($content_id = null, $section_id = null, $others=array())
	{
		$parameters = array('format' => 'json', 'action' => 'query', # parse | query
		                    'prop' => 'extracts', 'exintro' => '', 'explaintext' => '', 'titles' => $content_id,);
		$wikipedia_url = constant('HCI_WIKIPEDIA_API_URL') . '?' . http_build_query($parameters);

		return "View Source: <a href='{$wikipedia_url}'>{$wikipedia_url}</a>";

		/**
		 * @todo Correctly parse and render particular Wikipedia section
		 */
		$content_extracted = $this->fetch_url($wikipedia_url);
		$json = json_decode($content_extracted);
		$content = print_r($json, true);

		return $content;
	}

}
