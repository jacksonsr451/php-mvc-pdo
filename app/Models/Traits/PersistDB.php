<?php

namespace App\Models\Traits;

use App\Http\QueryBuilder\Insert;

trait PersistDB {

    public function insert($atributes) {
        $sql = Insert::SQLInsert($this->table, $atributes);
        $insert = $this->connect->prepare($sql);
        return $insert->execute($atributes);
    }

    public function update() {}
}