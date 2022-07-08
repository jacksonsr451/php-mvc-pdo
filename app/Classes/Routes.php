<?php

namespace App\Classes;

use Exception;

class Routes { 
    public static function load($routes, $uri) {
        try {
            if(!array_key_exists($uri, $routes)) {
                throw new \Exception("Route dont exists {$uri}");
            }
    
            $controller = self::getController($routes[$uri]);
            $controller = new $controller();
            $action = self::getMethod($controller, $routes[$uri]);

            $controller->$action();
        } catch (Exception $ex) {
            echo $ex->getMessage();
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
}