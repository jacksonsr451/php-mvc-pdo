<?php

namespace App\Http;


class Request {
    public function all() {
        return Validation::validate($_POST);
    }

    public function get($param) {
        return Validation::validate($_POST[$param]);
    }

    public function _() {
        return $_POST;
    }
}