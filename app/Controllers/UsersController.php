<?php

namespace App\Controllers;

use App\Models\UserModel;
use PhpEasyHttp\Http\Message\Interfaces\ServerRequestInterface;

class UsersController extends Controller
{
    public UserModel $users;

    public function __construct()
    {
        $this->users = new UserModel();
    }

    public function index(): void
    {
        $this->view('users/home_users', ["users" => $this->users->all()]);
    }

    public function show(array $params): void
    {
        $this->view("users/get_user");
    }

    public function create(ServerRequestInterface $request): void
    {
        // var_dump($request);
    }

    public function delete(array $params): void
    {
    }
}
