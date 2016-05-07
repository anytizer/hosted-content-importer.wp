<?php
$ymdhis = new hci_ymdhis();
$files = glob(HCI_PLUGIN_DIR . '/caches/*.cache');

if(!count($files))
	return;
?>
<div class="wrap">
	<h2>Cached files, [max age = <?php echo $ymdhis->age(HCI_CACHE_DURATION); ?>]</h2>
	<table class='data'>
		<thead>
		<tr>
			<td>S.N.</td>
			<td>Cached File Name</td>
			<td>File Size (Bytes)</td>
			<td>Modified On</td>
			<td>Age (HH:MM)</td>
		</tr>
		</thead>
		<tbody>
		<tr>
			<?php

			$counter = 0;
			foreach($files as $file)
			{
				++$counter;
				$basename = basename($file);
				$size = filesize($file);
				$created_on = filemtime($file);
				$age = time() - $created_on;
				$age_readable = $ymdhis->age($age);

				$created_on_date = date('Y-m-d H:i:s', $created_on);
				$row = "
<tr>
<td align='right'>{$counter}</td>
<td>{$basename}</td>
<td align='right'>{$size}</td>
<td>{$created_on_date}</td>
<td align='right'>{$age_readable}</td>
</tr>
	";

				echo $row;
			}
			?>
		</tbody>
	</table>
	<?php

	if(isset($_GET['purge']) && $_GET['purge'] == 'cache')
	{
		if(count($files))
		{
			if(wp_verify_nonce($_GET['nonce'], 'HCI'))
			{
				array_map('unlink', $files);
				echo "<p>Cache files removed.</p>";
			}
			else
			{
				echo "<p>Error validating delete request.</p>";
			}
		}
	}
	else
	{
		if(count($files))
		{
			/**
			 * Avoid accepting other $_GET parameters
			 */
			$GET = array('page' => !empty($_GET['page']) ? $_GET['page'] : '', 'purge' => 'cache', 'nonce' => wp_create_nonce('HCI'),);
			$get = http_build_query($GET);
			echo "<p><a href='edit.php?{$get}'>Delete all of these caches</a></p>";
		}
		else
		{
			echo "<p>No cached files, so far.</p>";
		}
	}
	?>
<p>Cache files with 0 Bytes will produce white screen.</p>
</div>
