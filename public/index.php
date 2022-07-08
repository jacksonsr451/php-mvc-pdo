<?php

require_once(__DIR__ . "/../bootstrap.php");

use App\Classes\Route;
use App\Classes\Uri;

require_once(__DIR__ . "/../app/routes.php");

$uri = Uri::load();

Route::load($uri);