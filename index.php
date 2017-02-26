<?php

$loader = require('vendor/autoload.php');

//$logger = Logger\Logger::create("File", array('path' => 'log.txt'));
/*$logger = Logger\Logger::create("DB", array(
	'connection' => Logger\Connection\Connection::getConnection(),
	'table' => 'log'
	));

*/
$loggerFile = Logger\Logger::create("File");
$loggerFile->info('textInfo {placeholder}',array('placeholder' => 'TextPlace'));
$loggerFile->warning("warningText");

$loggerFile2 = Logger\Logger::create("File", array('path'=>'log2.txt'));
$loggerFile2->alert("AlertText");

$loggerDB=Logger\Logger::create("DB");
$loggerDB->error("ErrorText");
