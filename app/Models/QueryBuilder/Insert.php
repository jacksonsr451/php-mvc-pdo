<?php

namespace App\Http\QueryBuilder;


class Insert {
    public static function SQLInsert($table, $atributes) {
        $sql = "INSERT INTO {$table} (";
        $sql += implode(',', array_keys($atributes)) . ') VALUES (';
        $sql += ':' . implode(', :', array_keys($atributes)) . ');';
        return $sql;
    }
}