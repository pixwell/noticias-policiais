<?php

namespace Core;

use PDO;

class DataBase
{
    public static function conn(){
        $dbConfig = include __DIR__ . '/../App/config/database.php';
        $host = $dbConfig['host'];
        $dbname = $dbConfig['dbname'];
        $user = $dbConfig['user'];
        $password = $dbConfig['password'];
        $charset = $dbConfig['charset'];
        $colation = $dbConfig['collation'];
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES '$charset' COLLATE '$colation'"
        );

        try {
            $conn = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $user, $password, $options);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            return $conn;
        } catch (\PDOException $e) {
            throw new \Exception( $e->getMessage() );
        }
    }    
}
