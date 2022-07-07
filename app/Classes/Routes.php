<?php

namespace App\Classes;

class Routes {
    public static function load($routes, $uri) {
        if(!array_key_exists($uri, $routes)) {
            throw new \Exception("Route dont exists {$uri}");
        }
        
        return "/../app/{$routes[$uri]}";
    }
}