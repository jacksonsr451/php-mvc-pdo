<?php

require_once(__DIR__ . "/../bootstrap.php");

use App\Bind;
use App\Configs\Middlewares\TestMiddleware;
use App\Dotenv;
use App\Http\Middleware\Queue;
use App\Http\Route;
use App\Http\Uri;
use App\Models\Connection;

Dotenv::init(__DIR__ . "/../.env")::load();

Bind::add('connect', Connection::getConnection());

require_once(__DIR__ . "/../app/routes.php");

$uri = Uri::load();

Queue::setMap([
    "middleware" => TestMiddleware::class
]);

Route::load($uri);