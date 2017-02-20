<?php
namespace Logger\Loggers;

use Logger;

class StreamLogger extends FileLogger
{
	public function __construct()
	{
		$this->openFile = fopen('php://stdout','a');
	}
}
