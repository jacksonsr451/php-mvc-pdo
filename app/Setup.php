<?php

use App\Bind;
use App\Configs\Middlewares\TestMiddleware;
use App\Http\Middleware\Queue as MiddlewareQueue;
use App\Models\Connection;

Bind::add('connect', Connection::getConnection());


MiddlewareQueue::setMap([
    "middleware" => TestMiddleware::class
]);