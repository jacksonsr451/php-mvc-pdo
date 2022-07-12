<?php

namespace App\Configs\Middlewares;

use App\Http\Middleware\MiddlewareInterface;
use App\Http\Request;
use Closure;
use Exception;

class TestMiddleware implements MiddlewareInterface 
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (getenv("TESTE") == 'true') throw new Exception("Test ok", 200);
        return $next($request);
    }
}