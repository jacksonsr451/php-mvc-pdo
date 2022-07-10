<?php

namespace App\Http\Middleware;

use Closure;

class Queue {
    private array $middleware = [];
    private Closure $controller;
    private array $args = [];

    public function __construct(array $middleware, Closure $controller, array $args)
    {
        $this->middleware = $middleware;
        $this->controller = $controller;
        $this->args = $args;
    }

}
