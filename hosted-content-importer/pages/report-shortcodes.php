<?php
function _shortcodes_handler_name($handler=null)
{
	$_handler = "{$handler}()";
	if(is_array($handler))
	{
		$_class = get_class($handler[0]);
		$_method = $handler[1];

		$_handler = "{$_class}::{$_method}()";
	}

	return $_handler;
}
?>
<div class="wrap">
<h3>Handlers of Shortcodes Registered (Dump)</h3>
	<table class='data'>
		<thead>
		<tr>
			<th>#</th>
			<th>Shortcode</th>
			<th>Handler</th>
		</tr>
		</thead>
		<tbody>
		<?php
		global $shortcode_tags;
		$counter = 0;
		foreach($shortcode_tags as $shortcode => $handler): ?>
		<tr>
			<td><?php echo ++$counter; ?>.</td>
			<td><?php echo $shortcode; ?></td>
			<td><?php echo _shortcodes_handler_name($handler); ?></td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
