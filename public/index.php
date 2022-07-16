<?php

use PhpEasyHttp\Http\Server\Route;

require_once(__DIR__ . "/../bootstrap.php");

use App\Dotenv;

Dotenv::init(__DIR__ . "/../.env")::load();

require_once(__DIR__ . "/../app/Setup.php");

require_once(__DIR__ . "/../app/Routes.php");

Route::load();
