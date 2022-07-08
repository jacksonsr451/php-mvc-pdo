<?php

require_once(__DIR__ . "/../bootstrap.php");

use App\Classes\Layout;
use App\Classes\Routes;
use App\Classes\Uri;


$routes = [
    '/' => 'Controllers/index.php',
    '/create_user' => 'Controllers/create_user.php',
];

$uri = Uri::load();

$layout = new Layout();

require_once(__DIR__ . Routes::load($routes, $uri));

require_once(__DIR__ . $layout->master("template"));