<?php

require_once(__DIR__ . "/../bootstrap.php");

use App\Dotenv;
use App\Http\Route;
use PhpEasyHttp\Http\Message\ServerRequest;
use PhpEasyHttp\Http\Message\Uri;

$scheme = "http";
if ($_SERVER[ "SERVER_PORT" ] === 443) $scheme = "https"; 

$uri = new Uri(sprintf('%s:/%s%s%s', $scheme, $_SERVER['REQUEST_URI'], $_SERVER['HTTP_HOST'], $_SERVER['REQUEST_URI'], $_SERVER['QUERY_STING'] === '' ? '' : '?'.$_SERVER['QUERY_STING']));

$request = new ServerRequest(
    $_SERVER['REQUEST_METHOD'],
    $uri,
    headers_list(),
    $_SERVER,
    $_COOKIE
);

Dotenv::init(__DIR__ . "/../.env")::load();

require_once(__DIR__ . "/../app/Setup.php");

require_once(__DIR__ . "/../app/Routes.php");

Route::load($uri);
