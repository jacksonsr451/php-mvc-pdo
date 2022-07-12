<?php

namespace App\Http;

class Request
{
    public function all(): object
    {
        return Validation::validate($_POST);
    }

    public function get($param): object
    {
        return Validation::validate($_POST[$param]);
    }

    public function _(): array
    {
        return $_POST;
    }
}
