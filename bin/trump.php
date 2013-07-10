#!/usr/bin/env php
<?php


$files = array(
  __DIR__ . '/../vendor/autoload.php',
);
foreach ($files as $file) {
    if (file_exists($file)) {
        require $file;

        define('TRUMP_COMPOSER_INSTALL', $file);

        break;
    }
}


$trump = new \Trump\TrumpTaskManager;
$trump->setTrumpFile(__DIR__ . '/../Trumpfile');

$trampFile = $trump->getTrumpFile();
$task = isset($argv[1]) ? $argv[1] : 'default';

foreach ($trampFile[$task] as $maker => $run) {
	$trump->setMaker($maker)->run($run);
}
