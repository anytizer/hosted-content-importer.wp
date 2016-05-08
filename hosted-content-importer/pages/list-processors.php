<?php
# List of available Conent Processors
$files = glob(HCI_PLUGIN_DIR . '/classes/processors/class.*.inc.php');

if(!count($files))
	return;
?>
<div class="wrap">
	<h2>Available - Content Processors</h2>
	<table class='data'>
		<thead>
		<tr>
			<td>S.N.</td>
			<td>Processor</td>
			<td>Status</td>
			<td>Usage</td>
		</tr>
		</thead>
		<tbody>
		<tr>
			<?php
			$counter = 0;
			$hci = new hosted_content_importer(); # To load SPL
			foreach($files as $file)
			{
				++$counter;
				$basename = basename($file);
				$processor = preg_replace('/^class\.processor_(.*?)\.inc\.php$/', '$1', $basename);

				/**
				 * Instantiate to check if the development was marked finished.
				 */
				$class_name = "processor_{$processor}";
				$dummy = new $class_name;
				$status = $dummy->completed() ? 'Completed' : 'Work in Progress';

				$row = "
<tr>
<td align='right'>{$counter}.</td>
<td>{$processor}</td>
<td>{$status}</td>
<td>[third source=\"{$processor}\" id=\"\" section=\"\"]</td>
</tr>
	";

				echo $row;
			}
			?>
		</tbody>
	</table>
	<h2>Extra Configurations</h2>
	<p>Current Page's QR Code: [third source="qr" id="url" section="internal"]</p>
	<!--<p><?php echo do_shortcode('[third source="qr" id="url" section="internal"]'); ?></p>-->
</div>
