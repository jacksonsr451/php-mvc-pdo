<?php

use App\Http\Route;

Route::get("/", "HomeController@index");

Route::get("/users", "UsersController@index");
Route::post("/users/add", "UsersController@create");
Route::get("/users/[0-9]+", "UsersController@show");