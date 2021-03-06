<?php

use PhpEasyHttp\Http\Server\Route;

Route::get("/", "HomeController@index", ['middleware']);

Route::get("users/", "UsersController@index");
Route::post("users/add/", "UsersController@create");
Route::get("users/[0-9]+/", "UsersController@show");
