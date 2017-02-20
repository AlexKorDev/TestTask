<?php

namespace Logger\Config;

class Config
{
	public static $components = array(
		'dbcomponents' =>array(
			'host' => 'localhost',
			'dbname' => 'loggers',
			'table' => 'log',
			'user' => 'root',
			'password' => ''
			),
		'filecomponents'=> array(
			'path' => 'log.txt'
			)
		);

}