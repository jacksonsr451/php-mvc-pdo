<?php

namespace App\Http\Middleware;

use Closure;
use PhpEasyHttp\Http\Message\Interfaces\ServerRequestInterface;

interface MiddlewareInterface
{
    public function handle(ServerRequestInterface $request, Closure $next): mixed;
}
