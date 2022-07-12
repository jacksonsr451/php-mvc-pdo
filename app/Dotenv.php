<?php

namespace App;

class Dotenv
{
    protected static string $path;

    public static function init(string $path): mixed
    {
        if(! file_exists($path)) {
            throw new \InvalidArgumentException(sprintf('%s does not exist', $path));
        }
        self::$path = $path;
        return self::class;
    }

    public static function load(): void
    {
        if (! is_readable(self::$path)) {
            throw new \RuntimeException(sprintf('%s file is not readable', self::$path));
        }

        $lines = file(self::$path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {

            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if (! array_key_exists($name, $_SERVER) && ! array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }
}


