<?php

use App\Http\Route;

Route::get("/", "HomeController@index");

Route::get("/users", "UsersController@index");
Route::post("/users/add", "UsersController@create");