<?php

namespace Logger\Loggers;

use Logger;

class FileLogger extends Logger\Logger
{
	protected $path;
	protected $openFile;

	public function __construct(array $parameters = array())
	{
		if (!empty($parameters)) {
			$this->setParameters($parameters);
		} else {
			$this->path = Logger\Config\Config::$components['filecomponents']['path'];
		}	
		$this->openFile = fopen($this->path, "a+");
	}

	public function log($level, $message, array $context = array())
	{
		$this->transformMessage($message,$context);
		$text=$this->getDate()." ".$level." ".$message." ".$this->contextToString($context).PHP_EOL;//";\n";
		fwrite($this->openFile, $text);
	}

	public function __destruct()
	{
		fclose($this->openFile);
	}
}