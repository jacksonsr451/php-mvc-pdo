<?php

namespace App\Http;


abstract class ValidationAbstract 
{
    private static array $validation = [];
    private static array $keys = [];

    public function __construct()
    {
        self::$keys = $this->fields();
    }

    protected function fields(): array 
    {
        return [

        ];
    }

    public static function validate($request = []): object
    {
        if (! empty($request)) {
            foreach ($request as $key => $value) {
                self::$validation[$key] = filter_var($value, FILTER_DEFAULT);
            }
        } else {
            foreach (self::$keys as $key => $value) {
                self::$validation[$key] = filter_var($value, FILTER_DEFAULT);
            }
        }

        return (object) self::$validation;
    }
}