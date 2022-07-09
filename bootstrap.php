<?php

use App\Bind;
use App\Models\Connection;

require_once(__DIR__ . "/vendor/autoload.php");

Bind::add('connect', Connection::getConnection());