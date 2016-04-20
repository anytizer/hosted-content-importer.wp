<?php
global $wpdb;
$pages_query = "
SELECT
	p.ID, 
	#p.post_content, 
	p.post_title, 
	p.guid 
FROM {$wpdb->posts} p
WHERE
	p.post_status = 'publish' 
	AND p.post_content LIKE '[third%'
ORDER BY p.post_date DESC
";
$posts = $wpdb->get_results($pages_query, OBJECT);
?>
<h2>Posts and Pages using [third] tag</h2>
<?php if ($posts): ?>
	<p>The below pages contain [third] tags.</p>
	<ol>
	<?php
	foreach ($posts as $post)
	{
		echo "<li><a href='{$post->guid}'>{$post->post_title}</a></li>";
	}
	?>
	</ol>
<?php else : ?>
	<p>[third] tags are not in use. Safe as normal.</p>
<?php endif; ?>
