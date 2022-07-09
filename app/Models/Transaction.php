<?php

namespace App\Models;

use Closure;
use Exception;

class Transaction extends Model {
    public function transaction(Closure $callback) {
        $this->connect->beginTransaction();
        try {
            $callback();
            $this->connect->commit();
        } catch (Exception $ex) {
            $this->connect->rollback();
        }
    }

    public function __get($name)
    {   
        if (!property_exists($this, $name)) {
            $model = __NAMESPACE__ . "\\" . $name;
            return new $model();
        }
    }
}