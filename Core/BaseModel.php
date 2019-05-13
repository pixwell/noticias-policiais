<?php

namespace Core;

abstract class BaseModel
{
    private $pdo;
    protected $table;

    public function __construct(PDO $objPDO)
    {
        $this->pdo = $objPDO;
    }
    
}