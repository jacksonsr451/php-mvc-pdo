<?php

namespace App\Http\Middleware;

use App\Http\Request;
use Closure;

class Queue {
    private array $middleware = [];
    private Closure $controller;
    private array $args = [];

    private static array $map = [];

    public function __construct(array $middleware, Closure $controller, array $args)
    {
        $this->middleware = $middleware;
        $this->controller = $controller;
        $this->args = $args;
    }

    public static function setMap($map) {
        self::$map = $map;
    }

    public function next(Request $request) {
        if (empty($this->middleware)) return call_user_func_array($this->controller, $this->args);
        echo "<pre>";
        print_r($this->middleware);
        echo "<pre>";
    }

}
