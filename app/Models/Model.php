<?php

namespace App\Models;

use App\Bind;
use App\Models\Traits\PersistDB;

abstract class Model
{
    use PersistDB;

    protected object $connect;
    protected string $table;

    public function __construct($table)
    {
        $this->table = $table;
        $this->connect = Bind::get('connect');
    }

    public function all(): array
    {
        $sql = "SELECT * FROM {$this->table}";
        $list = $this->connect->prepare($sql);
        $list->execute();

        return $list->fetchAll();
    }

    public function find($field, $value): mixed
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$field} = ?";
        $list = $this->connect->prepare($sql);
        $list->bindValue(1, $value);
        $list->execute();

        return $list->fetch();
    }

    public function delete($field, $value): bool
    {
        $sql = "DELETE FROM {$this->table} WHERE {$field} = ?";
        $delete = $this->connect->prepare($sql);
        $delete->bindValue(1, $value);
        $delete->execute();

        return $delete->rowCount();
    }
}
