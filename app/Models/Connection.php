<?php 

namespace App\Models;

use PDO;
use PDOException;
use PDOStatement;

class Connection {
    protected static object $pdo;    

    public function __construct(){}

    private static function connect(): void 
    {
        $host = getenv("HOST");
        $dbName = getenv("DB_NAME");
        $charset = getenv("CHARSET");
        $username = getenv("USERNAME");
        $password = getenv("PASSWORD");
        $setup = "mysql:host={$host};dbname={$dbName};charset={$charset};";
        try{
            self::$pdo = new PDO( $setup, $username, $password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        }catch(PDOException $ex){
            echo $ex->getMessage();
        }
    }

    public static function getConnection(): object
    {
        self::connect();
        return self::$pdo;
    }
}

