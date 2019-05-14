<?php

namespace Core;
use Core\DataBase;

abstract class BaseModel
{
    private $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = DataBase::conn();
    }
    
    public function all()
    {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $response = $stmt->fetchAll();
        $stmt->closeCursor();

        return $response;
    }
    
    public function insert($data)
    {
        $dataArray = (array) $data;
        $campos = implode(',', array_keys($dataArray));
        $placeholder = ':' . implode(',:', array_keys($dataArray));
        $valores = '';
        
        $query = 'INSERT INTO ' . $this->table . '(' . $campos . ') VALUES (' . $placeholder . ')';
        return $query;
        //$stmt = $pdo->prepare($query);
        //$stmt->execute($data);
    }
}