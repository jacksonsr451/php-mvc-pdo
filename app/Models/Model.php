<?php 

namespace App\Models;

use App\Models\Traits\PersistDB;

abstract class Model {
    use PersistDB;
    
    protected $connect;
    protected $table;

    public function __construct()
    {
        $this->connect = Connection::getConnection();
    }
 
    public function all() {
        $sql = "SELECT * FROM {$this->table}";
        $list = $this->connect->prepare($sql);
        $list->execute();

        return $list->fetchAll();
    }

    public function find($field, $value) {
        $sql = "SELECT * FROM {$this->table} WHERE {$field} = ?";
        $list = $this->connect->prepare($sql);
        $list->bindValue(1, $value);
        $list->execute();

        return $list->fetch();
    }
    
    public function delete($field, $value) {
        $sql = "DELETE FROM {$this->table} WHERE {$field} = ?";
        $delete = $this->connect->prepare($sql);
        $delete->bindValue(1, $value);
        $delete->execute();

        return $delete->rowCount();
    }
}