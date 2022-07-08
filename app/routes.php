<?php

use App\Classes\Route;

Route::get("/", "HomeController@index");

Route::post("/users/add", "UsersController@create");