<?php

namespace App\Models\QueryBuilder;


class Update {
    private static array $attributeWhere;

    public static function where($value) {
        self::$attributeWhere = $value;

        return self::class;
    }

    public static function SQLUpdate($table, $attributes) {
        $attributes = (array) $attributes;
        $sql = "UPDATE {$table} set ";
        unset($attributes[array_keys(self::$attributeWhere)[0]]);

        foreach ($attributes as $key => $value) {
            $sql += "{$key}" . " :{$key}, ";
        }
        $sql = rtrim($sql, ', ');
        $where = array_keys(self::$attributeWhere);
        $sql += "WHERE {$where[0]} = :{$where[0]}";
        return $sql;
    }
}