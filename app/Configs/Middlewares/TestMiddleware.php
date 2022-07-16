<?php

namespace App\Configs\Middlewares;

use Exception;
use PhpEasyHttp\Http\Message\Interfaces\ResponseInterface;
use PhpEasyHttp\Http\Message\Interfaces\ServerRequestInterface;
use PhpEasyHttp\Http\Message\Response;
use PhpEasyHttp\Http\Server\Interfaces\RequestHandlerInterface;
use PhpEasyHttp\Http\Server\Middleware;

class TestMiddleware extends Middleware
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (getenv("TESTE") == 'true') {
            throw new Exception("Test ok", 200);
        }

        return new Response(200, $handler->handle($request), []);
    }
}
