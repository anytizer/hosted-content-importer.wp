<?php

/**
 * Implementation left for developers
 * Cases: You may implement it yourself with your own logic
 */
class processor_database extends hosted_content_interface
{
	protected $as_is = false;
	protected $development_completed = false;

	/**
	 * Fetch content from the database, (possibly) reusing WordPress's existing connection
	 *
	 * @param string $content_id
	 * @param string $section_id
	 * @param array $others
	 *
	 * @return string
	 */
	public function fetch($content_id = null, $section_id = null, $others=array())
	{
		global $wpdb;

		switch($section_id)
		{
			case 'latest':
			case 'recent':
				$rows = $wpdb->get_results("SELECT post_title, guid FROM {$wpdb->prefix}posts WHERE post_type='post' AND post_status='publish' ORDER BY ID DESC LIMIT 20;");
				$li = array();
				foreach($rows as $row)
				{
					$li[] = "<li><a href='{$row->guid}'>{$row->post_title}</a></li>";
				}

				$html = '<ul>' . implode('', $li) . '</ul>';
				break;
			default:
				$html = "Fetching section [{$section_id}] is not implemented.";
		}

		return $html;
	}
}
