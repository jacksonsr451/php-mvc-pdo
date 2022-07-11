<?php

require_once(__DIR__ . "/../bootstrap.php");

use App\Configs\Middlewares\TestMiddleware;
use App\Dotenv;
use App\Http\Middleware\Queue;
use App\Http\Route;
use App\Http\Uri;

require_once(__DIR__ . "/../app/routes.php");

Dotenv::init(__DIR__ . "/../.env")::load();

$uri = Uri::load();

Queue::setMap([
    "middleware" => TestMiddleware::class
]);

Route::load($uri);