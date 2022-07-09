<?php

namespace App;


class Bind {
    private static array $bind = [];

    public static function add($key, $value) {
        self::$bind[$key] = $value;
    }

    public static function get($key) {
        return self::$bind[$key];
    }
}
