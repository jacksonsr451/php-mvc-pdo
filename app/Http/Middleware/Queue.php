<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use PhpEasyHttp\Http\Message\Interfaces\ServerRequestInterface;

class Queue
{
    private array $middleware = [];
    private Closure $controller;
    private array $args = [];

    private static array $map = [];
    private static array $default = [];
 
    public function __construct(array $middleware, Closure $controller, array $args)
    {
        $this->middleware = array_merge(self::$default, $middleware);
        $this->controller = $controller;
        $this->args = $args;
    }

    public static function setMap($map): void
    {
        self::$map = $map;
    }

    public static function setDefault($default): void
    {
        self::$default = $default;
    }

    public function next(ServerRequestInterface $request): mixed
    {
        if (empty($this->middleware)) {
            return call_user_func_array($this->controller, $this->args);
        }

        $middleware = array_shift($this->middleware);

        if (!isset(self::$map[$middleware])) {
            throw new Exception("Error this middleware {$middleware} dont exist in map!", 500);
        }

        $queue = clone $this;

        $next = function ($request) use ($queue) {
            return $queue->next($request);
        };

        return (new self::$map[$middleware]())->handle($request, $next);
    }
}
