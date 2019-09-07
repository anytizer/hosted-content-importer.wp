<?php
namespace cases;

use \processor_code;

use PHPUnit\Framework\TestCase;

class CodeTest extends TestCase
{
	public function testCodeWrapsHtml()
	{
		$processor = new processor_code();

        $code_url = 'http://localhost:99/';
		$html = $processor->fetch($code_url, $section = null, $others=array());
		$found = preg_match("/\\<\\/pre\\>/is", $html);

		$this->assertequals(1, $found);
	}
}
