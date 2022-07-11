<?php

require_once(__DIR__ . "/../bootstrap.php");

use App\Configs\Middlewares\TestMiddleware;
use App\Http\Middleware\Queue;
use App\Http\Route;
use App\Http\Uri;

require_once(__DIR__ . "/../app/routes.php");

$uri = Uri::load();

Queue::setMap([
    "middleware" => TestMiddleware::class
]);

Route::load($uri);