<?php
namespace Logger\Writers;

use Logger;

class StreamWriter extends FileWriter
{
	public function __construct()
	{
		$this->openFile = fopen('php://stdout','a');
	}
}
