<?php
# List of available Content Processors
$files = glob(HCI_PLUGIN_DIR . '/classes/processors/class.*.inc.php');

if(!count($files))
{
	/**
	 * No need to load this page any more
	 */
	return;
}
?>
<div class="wrap">
	<h2>Available - Content Processors</h2>
	<p><a href="https://github.com/bimalpoudel/hosted-content-importer/tree/master/hosted-content-importer/classes/processors" target="github">More about Content Proecssors</a></p>
	<table class='data'>
		<thead>
		<tr>
			<th>#</th>
			<th>Processor</th>
			<th>Status</th>
			<th>Usage</th>
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
	<p>Current Page's QR Code: <code>[third source="qr" id="url" section="internal"]</code>. Scan the below code for an example.</p>
	<p><?php echo do_shortcode('[third source="qr" id="url" section="internal"]'); ?></p>
</div>
