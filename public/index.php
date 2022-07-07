<?php

use App\Classes\Routes;
use App\Classes\Uri;

require_once(__DIR__ . "/../bootstrap.php");

$routes = [
    '/' => 'Controllers/index.php',
];

$uri = Uri::load();

require_once(__DIR__ . Routes::load($routes, $uri));
