<?php
global $wpdb;

$pages_query = "
SELECT
	p.ID,
	p.post_type,
	p.post_title, 
	p.guid,
	p.post_date
FROM {$wpdb->posts} p
WHERE
	p.post_status = 'publish'
	AND p.post_type IN ('post', 'page')
	AND p.post_content LIKE '%[third%'
ORDER BY
	p.post_title ASC,
	p.post_date DESC
";
$posts = $wpdb->get_results($pages_query, OBJECT);
?>

<div class="wrap">
	<h2>Reports on [third] tags usage</h2>
	<?php if($posts): ?>
		<p>These posts/pages have used <strong>[third]</strong> tags.</p>
		<table class='data'>
			<thead>
			<tr>
				<th>S.N.</th>
				<th>Posted On</th>
				<th>Type</th>
				<th>Title</th>
				<th>View</th>
				<th>Edit</th>
			</tr>
			</thead>
			<tbody>
			<?php
			$counter = 0;
			foreach($posts as $post):
				$permalink = get_permalink($post->ID);
				?>
				<tr>
					<td align="right"><?php echo ++$counter; ?>.</td>
					<td><?php echo $post->post_date; ?></td>
					<td><?php echo $post->post_type; ?></td>
					<td><?php echo "<a href='{$post->guid}'>{$post->post_title}</a>"; ?></td>
					<td><a href="<?php echo $permalink; ?>">View</a></td>
					<td><a href="post.php?post=<?php echo $post->ID; ?>&action=edit">Edit</a></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		<p>You may consider cleaning your posts listed above; before uninstalling <a
				href="https://wordpress.org/plugins/hosted-content-importer/">this plugin</a>.
		</p>
	<?php else : ?>
		<p>[third] tags are not in use. Safe as normal.</p>
	<?php endif; ?>
</div>
