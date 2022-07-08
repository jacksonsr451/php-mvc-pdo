<?php

namespace App\Http;


class Request {
    public function all() {
        return $_POST;
    }

    public function get($param) {
        return $_POST[$param];
    }
}