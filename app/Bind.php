<?php

namespace App;


class Bind 
{
    private static array $bind = [];

    public static function add($key, $value): void 
    {
        self::$bind[$key] = $value;
    }

    public static function get($key): mixed 
    {
        return self::$bind[$key];
    }
}
