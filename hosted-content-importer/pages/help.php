<?php
global $wpdb;

$pages_query = "
SELECT
	p.ID,
	p.post_type,
	p.post_title, 
	p.guid 
FROM {$wpdb->posts} p
WHERE
	p.post_status = 'publish'
	AND p.post_type IN ('post', 'page')
	AND p.post_content LIKE '[third%'
ORDER BY p.post_date DESC
";
$posts = $wpdb->get_results($pages_query, OBJECT);
?>

<div class="wrap">
<h2>Posts and Pages using [third] tag</h2>
<?php if ($posts): ?>
	<p>The below listed titles contain [third] tags.</p>
	<ol>
	<?php
	foreach ($posts as $post)
	{
		$permalink = get_permalink($post->ID);
		echo "<li>{$post->post_type}: <a href='{$post->guid}'>{$post->post_title}</a> - <a href='{$permalink}'>View</a> - <a href='post.php?post={$post->ID}&action=edit'>Edit</a></li>";
	}
	?>
	</ol>
	<div>Consider cleaning your posts listed above before uninstalling HCI plugin.</div>
<?php else : ?>
	<p>[third] tags are not in use. Safe as normal.</p>
<?php endif; ?>
</div>
