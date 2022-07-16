<?php

use App\Bind;
use App\Http\Middlewares\TestMiddleware;
use App\Models\Connection;
use PhpEasyHttp\Http\Server\RequestHandler;

Bind::add('connect', Connection::getConnection());

RequestHandler::setMap([
    'middleware' => TestMiddleware::class
]);

RequestHandler::setDefault([
    
]);
