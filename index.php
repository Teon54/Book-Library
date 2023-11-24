<?php

require_once 'vendor/autoload.php';

use App\Exception\InvalidCommandNameException;
use App\Exception\InvalidParameters;
use App\TaskManager;

try {
    (new TaskManager('commands.json'))->manageTask();
} catch (InvalidCommandNameException|InvalidParameters $e) {
    echo $e->getMessage();
}