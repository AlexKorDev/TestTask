<?php

namespace Logger;

use Psr\Log\LoggerInterface;
use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;

class Logger extends AbstractLogger 
{
	private $writers;

	public function __construct()
	{
		$this->writers = new \SplObjectStorage();
	} 

	public function addWriter(Writer $writer)
	{
		$this->writers->attach($writer);
	}

	public function removeWriter(Writer $writer)
	{
		$this->writers->detach($writer);
	}

	public function log($level, $message, array $context = array())
	{
		foreach ($this->writers as $writer) {
			$writer->log($level, $message, $context);
		}
	}

}