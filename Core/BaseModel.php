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
        $this->pdo = $this->conn();
    }
    
    public function conn(){
        $dbConfig = include __DIR__ . '/../App/config/database.php';
        $host = $dbConfig['host'];
        $dbname = $dbConfig['dbname'];
        $user = $dbConfig['user'];
        $password = $dbConfig['password'];
        $charset = $dbConfig['charset'];
        $colation = $dbConfig['collation'];

        try {
            $conn = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES '$charset' COLLATE '$colation'");
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            return $conn;
        } catch (\PDOException $e) {
            throw new \Exception( $e->getMessage() );
        }
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
        return $this->conn();
//        $stmt = $this->pdo->prepare($query);
//        $stmt->bindValue(':author', 'Agências internacionais');
//        $stmt->bindValue(':categories_id', 1);
//        $stmt->bindValue(':title', 'WhatsApp detecta vulnerabilidade que permite acesso de hackers a celulares');
//        $stmt->bindValue(':content', 'O aplicativo de mensagem instantânea WhatsApp, de propriedade do Facebook, informou na segunda-feira (13) que detectou uma vulnerabilidade em seu sistema que permitia que hackers instalassem um tipo de "spyware", um software para ter acesso a dados do aparelho, em alguns telefones. A empresa confirmou em comunicado à imprensa a informação publicada horas antes pelo "Financial Times" e pediu ao 1,5 bilhão de usuários em todo o mundo que "atualizem o aplicativo para sua versão mais recente" e mantenham durante o dia seu sistema operativo como medida de "proteção".');
//        $response = $stmt->execute();
//        $stmt->closeCursor();
//        return $response;

        
//        $stmt = $this->pdo->prepare($query);
//        
//        for ($i = 0; $i < count($placeArray); $i++) {
//            $stmt->bindValue($placeArray[$i], $valores[$i]);
//        }
//        $response = $stmt->execute();
//        $stmt->closeCursor();
//        return $response;
    }
}