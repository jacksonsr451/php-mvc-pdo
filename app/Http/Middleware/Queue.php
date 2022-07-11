<?php

namespace App\Http\Middleware;

use App\Http\Request;
use Closure;
use Exception;

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
        
        $middleware = array_shift($this->middleware);
        
        if(!isset(self::$map[$middleware])) {
            throw new Exception("Error this middleware {$middleware} dont exist in map!", 500);
        }

        $queue = $this;

        $next = function ($request) use ($queue) {
            return $queue->next($request);
        };

        return (new self::$map[$middleware])->handle($request, $next);
    }

}
