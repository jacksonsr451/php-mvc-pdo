<?php

require_once(__DIR__ . "/../bootstrap.php");

use App\Classes\Routes;
use App\Classes\Uri;


$routes = [
    '/' => 'HomeController@index',
];

$uri = Uri::load();

require_once(__DIR__ . Routes::load($routes, $uri));