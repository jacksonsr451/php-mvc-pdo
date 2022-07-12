<?php

namespace App\Models;

class PostModel extends Model 
{
    public function __construct()
    {
        parent::__construct("posts");
    }
}