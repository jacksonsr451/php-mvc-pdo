<?php

namespace App\Http;

use App\Http\Middleware\Queue;
use Exception;
use PhpEasyHttp\Http\Message\Interfaces\ServerRequestInterface;
use PhpEasyHttp\Http\Message\ServerRequest;

class Route
{
    private static array $routes;
    private static ServerRequestInterface $request;
    private static array $params = [];

    public static function load($uri): void
    {
        $path = $uri->getPath();
        try {
            if (! array_key_exists($path, self::$routes)) {
                if (! self::validateUriWithParams($path)) {
                    throw new Exception("Route dont exists {$path}");
                } else {
                    foreach (self::validateUriWithParams($path) as $key => $value) {
                        $route = $value;
                    }
                }
            } else {
                $route = self::$routes[$path];
            }

            $controller = self::getController($route);
            $controller = new $controller();
            $action = self::getMethod($controller, $route);

            (new Queue($route['middlewares'], function () use ($controller, $action) {
                self::loadMethod($controller, $action);
            }, []))->next(self::$request);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    private static function validateUriWithParams($uri): array
    {
        $matcheUri = array_filter(
            self::$routes,
            function ($value) use ($uri) {
                echo "<pre>";
                print_r($uri);
                echo "<pre>";
                $regex = str_replace('/', '\/', ltrim($value, '/'));
                return preg_match("/^{$regex}$/", ltrim($uri, '/'));
            },
            ARRAY_FILTER_USE_KEY
        );
        self::setParams($uri, key($matcheUri));
        return $matcheUri;
    }

    private static function setParams($uri, $route): void
    {
        $uri = explode('/', $uri);
        $route = explode('/', $route);
        self::$params = array_diff($uri, $route);
    }

    private static function loadMethod($controller, $action): bool
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $controller->$action(self::$request);
                break;

            case 'PUT':
                $controller->$action(self::$params, self::$request);
                break;

            case 'DELETE';
                $controller->$action(self::$params);
                break;

            default:
                if (empty(self::$params)) {
                    $controller->$action();
                } else {
                    $controller->$action(self::$params);
                }
                break;
        }
        return true;
    }

    private static function getController($routes): string
    {
        $classes = explode("@", $routes['controller']);
        $namespace = "App\\Controllers\\{$classes[0]}";

        if (!class_exists($namespace)) {
            throw new Exception("Class dont exists {$classes[0]}");
        }

        return $namespace;
    }

    private static function getMethod($classes, $routes): string
    {
        $method = explode("@", $routes['controller']);

        if (!method_exists($classes, $method[1])) {
            throw new Exception("Method dont exists {$method[1]}");
        }

        return $method[1];
    }

    public static function get($route, $controller, array $middlewares = []): void
    {
        self::$routes[$route] = array('controller' => $controller, 'middlewares' => $middlewares);
    }

    public static function post($route, $controller, array $middlewares = []): void
    {
        self::$request = new ServerRequest(
            'POST',
            headers_list(),
            $_SERVER,
            $_COOKIE,
        );
        self::$routes[$route] = array('controller' => $controller, 'middlewares' => $middlewares);
    }

    public static function delete($route, $controller, array $middlewares = []): void
    {
        self::$routes[$route] = array('controller' => $controller, 'middlewares' => $middlewares);
    }

    public static function put($route, $controller, array $middlewares = []): void
    {
        self::$routes[$route] = array('controller' => $controller, 'middlewares' => $middlewares);
    }
}
