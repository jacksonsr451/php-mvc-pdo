<?php

require_once(__DIR__ . "/../bootstrap.php");

use App\Http\Middleware\Queue;
use App\Http\Route;
use App\Http\Uri;

require_once(__DIR__ . "/../app/routes.php");

$uri = Uri::load();

Route::load($uri);

Queue::setMap([
    
]);