<?php

use App\Configs\Middlewares\TestMiddleware;
use PhpEasyHttp\Http\Server\Route;
use PhpEasyHttp\Http\Server\RequestHandler;

require_once(__DIR__ . "/../bootstrap.php");

use App\Dotenv;

Dotenv::init(__DIR__ . "/../.env")::load();

require_once(__DIR__ . "/../app/Setup.php");

require_once(__DIR__ . "/../app/Routes.php");

RequestHandler::setMap([
    'middleware' => TestMiddleware::class
]);

RequestHandler::setDefault([
    
]);

Route::load();
