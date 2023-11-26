<?php

require __DIR__.'/../vendor/autoload.php';
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


$logger = new Logger('my_logger');
$logger->pushHandler(new StreamHandler(__DIR__.'/../logs/app.log', Logger::DEBUG));

$logger->info('I just got the logger');
$logger->warning('I am warning you');
$logger->error('I am an error');
$logger->critical('I am critical');
$logger->alert('I am alerting you');
$logger->emergency('I am in emergency');