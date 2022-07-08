<?php

namespace App\Controllers;


class UsersController extends Controller {
    public function create($param) {
        dd($param['id']);
        die;
    }
}