<?php

use App\Models\UserModel;

$user = new UserModel;

dd($user->all());

require_once(__DIR__ . "/../Views/index.php");