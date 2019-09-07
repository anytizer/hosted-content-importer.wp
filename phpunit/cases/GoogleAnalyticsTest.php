<?php
namespace cases;

use \processor_analytics;

use PHPUnit\Framework\TestCase;

class GoogleAnalyticsTest extends TestCase
{
	public function testGoogleAnalyticsContainsTrackingCode()
	{
		$processor = new processor_analytics();

        $tracking_code = 'UU-XXXXXXXX-Y';
		$html = $processor->fetch($tracking_code, $section = null, $others=array());

		$this->assertequals(421, strlen($html));
	}
}
