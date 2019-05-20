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
    
    public function all($orderBy = null, $limit = null)
    {
        //SELECT * FROM `news` ORDER BY created_at DESC LIMIT 5;
        $query = 'SELECT * FROM ' . $this->table . ($orderBy ? ' ORDER BY ' . $orderBy : '') . ($limit ? ' LIMIT ' . $limit : '');
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $response = $stmt->fetchAll();
        $stmt->closeCursor();

        return $response;
    }
    
    /**
     * Insert de dados no banco de dados
     * O objeto enviado deve ter a chave com o mesmo nome da coluna no BD
     * @param object $data
     * @return boolean
     */
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
    
    public function find($id)
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $response = $stmt->fetch();
        $stmt->closeCursor();

        return $response;
    }
    
    /**
     * Select com a clausula WHERE
     * Padrao de busca simples: [0 => 'campo', 1 => 'valor', 2 => 'operador']
     * 2 condicoes ou mais (AND): 
     * [['campo1', 'valor1'], ['campo2', 'valor2', '>'], ['campo2', 'valor2', '<']];
     * 
     * @param array $where
     * @return void
     */
    public function findWhere(array $where, $orderBy = null, $limit = null)
    {
        //E um array multidimensional?
        if( array_filter($where, 'is_array') ){
            foreach( $where as $whereItem ){
                /* Se o operador na posicao 2 do array nao for definido, entao 
                 * sera 0 " = " (igual), senao sera o operador definido */
                $operator =  (!isset($whereItem[2]) || empty($whereItem[2])) ? '=' : $whereItem[2];
                //Montando a condicao: campo [OPERADOR] valor
                $conditionItem[] =  '`'.$whereItem[0].'`' . ' ' . $operator . " '".$whereItem[1]."'";
            }            
            //Juntar todos os itens e formando a string com a condicao
            $condition = implode(' AND ', $conditionItem);
        } else {
            $operator = (!isset($where[2]) || empty($where[2])) ? '=' : $where[2];
            $condition = '`'.$where[0].'`' . ' ' . $operator . " '".$where[1]."'";
        }
        //SELECT * FROM `news` WHERE `author` = 'Nullam erat erat ORDER BY created_at DESC';
        $query = 'SELECT * FROM ' . $this->table . ' WHERE ' . $condition . ($orderBy ? ' ORDER BY ' . $orderBy : '') . ($limit ? ' LIMIT ' . $limit : '');
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $response = $stmt->fetchAll();
        $stmt->closeCursor();

        return $response;
    }
    
    
    public function update(int $id, array $setValues)
    {
        //Criando strings coluna = 'valor'
        foreach( $setValues as $key => $value ){
            $campos[] = "`$key` = '$value'";
        }
        //UPDATE news SET `active` = 0, `title` = 'Título alterado', `slug` = 'lorem-ipsum-sit-amet' WHERE id = :id
        $query = 'UPDATE ' . $this->table . ' SET ' . implode(', ', $campos) . ' WHERE id = :id';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':id', $id);
        $response = $stmt->execute();
        $stmt->closeCursor();
        return $response;
    }
}