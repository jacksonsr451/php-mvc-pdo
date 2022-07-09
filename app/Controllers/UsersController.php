<?php

namespace App\Controllers;

use App\Http\Request;
use App\Models\UserModel;

class UsersController extends Controller {
    public UserModel $users;

    public function __construct()
    {
        $this->users = new UserModel();
    }

    public function index() {
        $this->view('users/index', ["users" => $this->users->all()]);
    }

    public function show($id) {

    }
 
    public function create(Request $request) {
        dd($request->all());
        die;
    }

    public function delete($id) {

    }
}