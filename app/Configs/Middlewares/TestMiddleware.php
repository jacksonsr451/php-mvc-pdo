<?php

namespace App\Configs\Middlewares;

use App\Http\Middleware\MiddlewareInterface;
use Closure;
use Exception;
use PhpEasyHttp\Http\Message\Interfaces\ServerRequestInterface;

class TestMiddleware implements MiddlewareInterface
{
    public function handle(ServerRequestInterface $request, Closure $next): mixed
    {
        if (getenv("TESTE") == 'true') {
            throw new Exception("Test ok", 200);
        }
        return $next($request);
    }
}
