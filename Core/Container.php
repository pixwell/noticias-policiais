<?php

namespace Core;

class Container
{
    public static function dispatcher($controller)
    {
        $classe = 'App\\Controller\\' . $controller;
        if( class_exists($classe) ){
            return new $classe;
        } else {
            throw new \Exception('Classe não existe');
        }
        
    }
}
