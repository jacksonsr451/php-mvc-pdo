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
        $this->view('users/home_users', ["users" => $this->users->all()]);
    }

    public function show(array $params) {
        $this->view("users/get_user");
    }
 
    public function create(Request $request) {
        
    }

    public function delete($id) {

    }
}