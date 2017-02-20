<?php

$loader = require('vendor/autoload.php');

//$logger = Logger\Logger::create("File", array('path' => 'log.txt'));
/*$logger = Logger\Logger::create("DB", array(
	'connection' => Logger\Connection\Connection::getConnection(),
	'table' => 'log'
	));

*/
$logger = Logger\Logger::create("File");
//$logger = Logger\Logger::create("Stream");
//$logger = Logger\Logger::create("DB");
$logger->info('textInfo {placeholder}',array('placeholder' => 'TextPlace'));
$logger->warning("warningText");