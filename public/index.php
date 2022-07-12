<?php

require_once(__DIR__ . "/../bootstrap.php");

use App\Dotenv;
use App\Http\Route;
use App\Http\Uri;

Dotenv::init(__DIR__ . "/../.env")::load();

require_once(__DIR__ . "/../app/Setup.php");

require_once(__DIR__ . "/../app/routes.php");

$uri = Uri::load();

Route::load($uri);