<?php

namespace App\Models\Traits;

use App\Http\QueryBuilder\Insert;
use App\Http\QueryBuilder\Update;

trait PersistDB {

    public function insert($attributes) {
        $attributes = (array) $attributes;
        $sql = Insert::SQLInsert($this->table, $attributes);
        $insert = $this->connect->prepare($sql);
        return $insert->execute($attributes);
    }

    public function update($attributes, $where) {
        $attributes = (array) $attributes;
        $sql = Update::where($where)::SQLUpdate($this->table, $attributes);
        $update = $this->connect->prepare($sql);
        $update->execute($attributes);
        return $update->rowCount();
    }
}