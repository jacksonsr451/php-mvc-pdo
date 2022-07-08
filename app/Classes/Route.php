<?php

namespace App\Classes;

use Exception;

class Route { 
    private static array $routes;
    private static $params;

    public static function load($uri) {
        try {
            if(!array_key_exists($uri, self::$routes)) {
                throw new \Exception("Route dont exists {$uri}");
            }
    
            $controller = self::getController(self::$routes[$uri]);
            $controller = new $controller();
            $action = self::getMethod($controller, self::$routes[$uri]);

            self::loadMethod($controller, $action);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    private static function loadMethod($controller, $action) {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $controller->$action(self::$params);
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
        self::$params = $_POST;
        self::$routes[$route] = $controller;
    }

    public static function delete($route, $controller) {
        self::$routes[$route] = $controller;
    }

    public static function put($route, $controller) {
        self::$routes[$route] = $controller;
    }
}