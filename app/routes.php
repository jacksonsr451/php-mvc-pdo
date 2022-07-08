<?php

use App\Http\Route;

Route::get("/", "HomeController@index");

Route::post("/users/add", "UsersController@create");