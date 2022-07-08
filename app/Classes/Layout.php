<?php

namespace App\Classes;


class Layout {
    private $view;
 
    public function add($view) {
        $this->view = $view;
    }

    public function load() {
        require_once(__DIR__ . "/../Views/{$this->view}.php");
    }

    public function master($template) {
        return "/../app/Views/{$template}.php";
    }
}