<?php

namespace Logger\Connection;

class Connection
{
	public static function getConnection()
	{
		$config = \Logger\Config\Config::$components['dbcomponents'];
		$dsn = "mysql:host={$config['host']};dbname={$config['dbname']}";
		$db = new \PDO($dsn, $config['user'], $config['password']);
		return $db;
	} 
}