<?php

namespace App\Models;

use Closure;
use Exception;

class Transaction extends Model
{
    public function transaction(Closure $callback): void
    {
        $this->connect->beginTransaction();
        try {
            $callback();
            $this->connect->commit();
        } catch (Exception $ex) {
            $this->connect->rollback();
        }
    }

    public function model($model): mixed
    {
        return new $model();
    }

    public function __get($name): mixed
    {
        if (!property_exists($this, $name)) {
            $model = __NAMESPACE__ . "\\" . $name;
            return new $model();
        }
    }
}
