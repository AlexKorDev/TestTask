<?php

$loader = require('vendor/autoload.php');

$writerFile = new Logger\Writers\FileWriter();
$writerFile2 = new Logger\Writers\FileWriter(['path'=>'log2.txt']);
$writerDB = new Logger\Writers\DBWriter();

$logger = new Logger\Logger();
$logger->addWriter($writerFile);
$logger->addWriter($writerDB);
$logger->addWriter($writerFile2);

$logger->info("TextInfo");
$logger->alert("TextAlert");