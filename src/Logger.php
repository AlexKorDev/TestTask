<?php

namespace Logger;

use Psr\Log\LoggerInterface;
use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;

abstract class Logger extends AbstractLogger 
{
	private static $logger = null; 

	public static function create($type, array $parameters = array()) 
	{
		if (empty(self::$logger)) {
			$className = 'Logger\\Loggers\\'.$type.'Logger';
			self::$logger = new $className($parameters);
			return self::$logger;
		} else {
			return self::$logger;
		}
	}

	protected function setParameters(array $parameters = array())
	{
		foreach ($parameters as $parameter => $value)
		{
			if (property_exists($this, $parameter)) {
				$this->$parameter = $value;
			}
		}
	}
	
	//from psr-3
	protected function interpolate($message, array $context = array()) 
	{
     	$replace = array();
    	foreach ($context as $key => $val) {
        	$replace['{' . $key . '}'] = $val;
      	}
      	return strtr($message, $replace);
    }

    protected function transformMessage(&$message, &$context){
    	if (is_string($message) && !empty($context)) {
			$message = $this->interpolate($message, $context);
			//$context=array();
		} elseif (is_object($message)) {
			if (method_exists($message, '__toString'))
			{
				$message = (string) $message;
			} else {
				$message = serialize($message);
			}
		} elseif (is_array($message)) {
			$message = json_encode($message);
		}
    }

    protected function getDate($format = 'Y-m-d H:i:s') 
    {
    	return (new \DateTime())->format($format);
    }

    protected function contextToString(array $context = array())
	{
		return !empty($context) ? json_encode($context) : "";
	}

	private function __construct() {}
	private function __clone() {}
	private function __wakeup() {}
}