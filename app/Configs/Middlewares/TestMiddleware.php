<?php

namespace App\Configs\Middlewares;

use App\Http\Middleware\MiddlewareInterface;
use App\Http\Request;
use Closure;

class TestMiddleware implements MiddlewareInterface {
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}