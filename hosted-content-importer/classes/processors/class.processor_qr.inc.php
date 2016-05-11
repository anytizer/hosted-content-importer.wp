<?php

/**
 * QR Code Image with Google Charts
 *
 * Usage Examples:
 * [third source="qr" id="http://www.example.com/" section="custom"]
 * [third source="qr" id="url" section="internal"]
 *
 * https://developers.google.com/chart/infographics/docs/qr_codes#qr-code-details-optional-reading
 * https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=Hello%20world&choe=UTF-8
 */
class processor_qr extends hosted_content_interface
{
	protected $development_completed = true;

	public function fetch($data = 'http://www.example.com/', $section = null, $others=array())
	{
		switch(true)
		{
		case $section==='internal':
			if($data==='url')
			{
				/**
				 * Current page's full URL
				 * [third source="qr" id="url" section="internal"]
				 */
				$data = $this->http_referer();
			}
			break;
		default:
			# The normal way
		}

		$parameters = array(
			'chs' => '150x150',
			'cht' => 'qr',
			'chl' => $data,
			'choe' => 'UTF-8',
		);
		$query = http_build_query($parameters);
		$src = "https://chart.googleapis.com/chart?{$query}";
		
		$html = "<img src='{$src}' height=150 width='150' class='hci-qr' />";
		return $html;
	}
}
