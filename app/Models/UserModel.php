<?php 

namespace App\Models;

class UserModel extends Model 
{
    public function __construct()
    {
        parent::__construct("users");
    }
}