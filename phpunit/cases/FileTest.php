<?php
namespace cases;

use \processor_file;

use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
	public function testFileReadsContents()
	{
		$processor = new processor_file();

		$html = $processor->fetch("d:/test.py", $section = null, $others=array());

		$this->assertequals(169, strlen($html));
	}
}
