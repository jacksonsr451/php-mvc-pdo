<?php

namespace PhpEasyHttp\Http\Server;

use Closure;
use PhpEasyHttp\Http\Message\Interfaces\ResponseInterface;
use PhpEasyHttp\Http\Message\Interfaces\ServerRequestInterface;
use PhpEasyHttp\Http\Server\Exceptions\MiddlewareException;
use PhpEasyHttp\Http\Server\Interfaces\RequestHandlerInterface;

class RequestHandler implements RequestHandlerInterface
{
    private array $middleware = [];
    private Closure $controller;
    private array $args = [];

    private array $map = [];
    private array $default = [];

    public function __construct(array $middleware, Closure $controller, array $args)
    {
        $this->middleware = array_merge($this->default, $middleware);
        $this->controller = $controller;
        $this->args = $args;
    }

    public static function setMap($map): void
    {
        $tokens = new CsrfTokenMiddleware($_SESSION, getenv("LIMIT_TOKEN"));
        self::$map = array_merge(['_csrf_tokens' => $tokens], $map);
    }

    public static function setDefault($default): void
    {
        self::$default = array_merge(['_csrf_tokens'], $default);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if (empty($this->middleware)) {
            return call_user_func_array($this->controller, $this->args);
        }

        $middleware = array_shift($this->middleware);

        if (!isset($this->map[$middleware])) {
            throw new MiddlewareException("Error this middleware {$middleware} dont exist in map!", 500);
        }

        $clone = clone $this;

        $handle = function ($request) use ($clone) {
            return $clone->handle($request);
        };

        return (new $this->map[$middleware]())->process($request, $handle);
    }
}
