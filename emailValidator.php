<?php

require_once __DIR__ . '/vendor/autoload.php';

use Factory\CommandFactory;

$command = CommandFactory::getReadCsvEmailsCommandWithLogExceptions();

$command->run($argc, $argv);

