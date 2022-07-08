<?php

namespace App\Controllers;

use App\Http\Request;

class UsersController extends Controller {
    public function create(Request $request) {
        dd($request->all());
        die;
    }
}