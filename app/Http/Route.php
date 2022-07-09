<?php

namespace App\Http;

use Exception;

class Route { 
    private static array $routes;
    private static Request $request;
    private static array $params;

    public static function load($uri) {
        try {
            if(!array_key_exists($uri, self::$routes)) {
                if (!self::validateUriWithParams($uri)) {
                    throw new \Exception("Route dont exists {$uri}");
                } else {
                    // TODO: Melhorar a implementação de key
                    $controller = self::getController(self::validateUriWithParams($uri)[key(self::validateUriWithParams($uri))]);        
                    $controller = new $controller();
                    $action = self::getMethod($controller, self::validateUriWithParams($uri)[key(self::validateUriWithParams($uri))]);
                }
            } else {
                // TODO: Remover duplicação de código
                $controller = self::getController(self::$routes[$uri]);
                $controller = new $controller();
                $action = self::getMethod($controller, self::$routes[$uri]);
            }

            self::loadMethod($controller, $action);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    private static function validateUriWithParams($uri) {
        $matcheUri = array_filter(
            self::$routes,
            function ($value) use ($uri) {
                $regex = str_replace('/', '\/', ltrim($value, '/'));
                return preg_match("/^{$regex}$/", ltrim($uri, '/'));
            },
            ARRAY_FILTER_USE_KEY
        );
        return $matcheUri;
    }

    private static function loadMethod($controller, $action) {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $controller->$action(self::$request);
                break;
            
            default:
                $controller->$action();
                break;
        }
    }

    private static function getController($routes) {
        $classes = explode("@", $routes);
        $namespace = "App\\Controllers\\{$classes[0]}";

        if (!class_exists($namespace)) {
            throw new \Exception("Class dont exists {$classes[0]}");
        }

        return $namespace;
    }

    private static function getMethod( $classes, $routes) {
        $method = explode("@", $routes);

        if (!method_exists($classes, $method[1])) {
            throw new \Exception("Method dont exists {$method[1]}");
        }

        return $method[1];
    }

    public static function get($route, $controller) {
        self::$routes[$route] = $controller;
    }

    public static function post($route, $controller) {
        self::$request = new Request();
        self::$routes[$route] = $controller;
    }

    public static function delete($route, $controller) {
        self::$routes[$route] = $controller;
    }

    public static function put($route, $controller) {
        self::$routes[$route] = $controller;
    }
}