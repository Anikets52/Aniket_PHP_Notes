<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\JsonFormatter;

require "vendor/autoload.php";

$logger = new Logger('App');
$handler = new StreamHandler("Log/App.log");

$formatter = new JsonFormatter();
$formatter->setJsonPrettyPrint(true);
$handler->setFormatter($formatter);

$logger->pushHandler($handler);


$logger->pushProcessor(function ($record) {
    $record['extra']['ips'] = 12;
    return $record;
});


$logger->info('Aniket', ['MESSAGE' => "Database Failure", "Status" => 600]);
$logger->warning('AniketW', ['MESSAGE' => "DatabaseW Failure", "Status" => 400]);
$logger->error('AniketE', ['MESSAGE' => "DatabaseE Failure", "Status" => 300]);


$logger2 = new Logger('App2');
$logger2->pushHandler($handler);
$logger2->info('Aniket', ['MESSAGE' => "Database Failure", "Status" => 600]);
$logger2->warning('AniketW', ['MESSAGE' => "DatabaseW Failure", "Status" => 400]);
$logger2->error('AniketE', ['MESSAGE' => "DatabaseE Failure", "Status" => 300]);
