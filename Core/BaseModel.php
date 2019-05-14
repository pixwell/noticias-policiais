<?php

namespace Core;

use PDO;
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
        //A consulta no BD retorna um OBJ, portanto ele deve ser convertido para array
        $dataArray = (array) $data;        
        //Junstando as chaves do array e criando a string com os nomes dos campos
        $campos = implode(',', array_keys($dataArray));
        //Juntando as chaves e criando uma string com os placeholders
        $placeholder = ':' . implode(',:', array_keys($dataArray));
        //Separando os placeholders criados para serem usados no bindValue()
        $placeArray = explode(',', $placeholder);
        //Valores do $dataArray para serem usados no bindValue()
        $valores = array_values($dataArray);
        
        $query = 'INSERT INTO ' . $this->table . ' (' . $campos . ') VALUES (' . $placeholder . ')';
        $stmt = $this->pdo->prepare($query);
        
        for ($i = 0; $i < count($placeArray); $i++) {
            $stmt->bindValue($placeArray[$i], $valores[$i]);
        }
        $response = $stmt->execute();
        $stmt->closeCursor();
        return $response;
    }
}