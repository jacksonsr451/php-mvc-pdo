<?php

namespace App\Models\QueryBuilder;

class Insert
{
    public static function SQLInsert($table, $attributes): string
    {
        $attributes = (array) $attributes;
        $sql = "INSERT INTO {$table} (";
        $sql += implode(',', array_keys($attributes)) . ') VALUES (';
        $sql += ':' . implode(', :', array_keys($attributes)) . ');';
        return $sql;
    }
}
