<?php

namespace App\Models\Traits;

use App\Http\QueryBuilder\Insert;
use App\Http\QueryBuilder\Update;

trait PersistDB {

    public function insert($attributes) {
        $sql = Insert::SQLInsert($this->table, $attributes);
        $insert = $this->connect->prepare($sql);
        return $insert->execute($attributes);
    }

    public function update($attributes, $where) {
        $sql = Update::where($where)::SQLUpdate($this->table, $attributes);
        $update = $this->connect->prepare($sql);
        $update->execute($attributes);
        return $update->rowCount();
    }
}