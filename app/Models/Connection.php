<?php 

namespace App\Models;

use PDO;
use PDOException;

class Connection {
    protected static $pdo;
    public function __construct(){}

    private static function connect() {
        $config = require_once(__DIR__ . "/../../config.php");
        $setup = "mysql:host={$config["db"]["host"]};dbname={$config["db"]["db_name"]};charset={$config["db"]["charset"]};";
        $username = $config["db"]["username"];
        $password = $config["db"]["password"];
        try{
            self::$pdo = new PDO( $setup, $username, $password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        }catch(PDOException $ex){
            echo $ex->getMessage();
        }
    }

    public static function getConnection(){
        self::connect();
        return self::$pdo;
    }
}

