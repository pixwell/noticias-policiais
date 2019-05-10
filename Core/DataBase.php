<?php

namespace Core;

use PDO;

class DataBase
{
    public function conn(){
        $dbConfig = __DIR__ . '/../App/config/database.php';

        if( $dbConfig['driver'] == 'mysql' ){
            $host = $dbConfig['mysql']['host'];
            $dbname = $dbConfig['mysql']['dbname'];
            $user = $dbConfig['mysql']['user'];
            $password = $dbConfig['mysql']['password'];
            $charset = $dbConfig['mysql']['charset'];
            $colation = $dbConfig['mysql']['collation'];

            try {
                $conn = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $user, $pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES '$charset' COLLATE '$colation'");
                $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                return $conn;
            } catch (\PDOException $e) {
                throw new \Exception( $e->getMessage() );
            }

        }//if
    }    
}
