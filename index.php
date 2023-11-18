<?php

require_once 'vendor/autoload.php';

use App\Request;

print_r((new Request('commands.json')));