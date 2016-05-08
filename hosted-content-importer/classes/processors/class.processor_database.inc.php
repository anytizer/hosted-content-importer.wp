<?php

/**
 * Implementation left for developers
 * Cases: You may implement it yourself with your own logic
 */
class processor_database extends hosted_content_interface
{
	protected $development_completed = true;

	/**
	 * Fetch content from the database, (possibly) reusing WordPress's existing connection
	 *
	 * @param mixed $content_id
	 * @param mixed $section_id
	 *
	 * @return string
	 */
	public function fetch($content_id = null, $section_id = null)
	{
		global $wpdb;

		$html = 'Reading contents from local DATABASE.';
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
