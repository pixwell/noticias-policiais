<?php

namespace Core;

class Container
{
    /**
     * Dispatcher para instanciar a classe
     *
     * @param  string $controller
     *
     * @return object
     */
    public static function dispatcher($controller)
    {
        $classe = 'App\\Controller\\' . $controller;
        if( class_exists($classe) ){
            return new $classe;
        } else {
            http_response_code(404);
            throw new \Exception('Classe não existe');
        }
        
    }
    
    public static function pageNotFound($isAdmin = false)
    {
        if($isAdmin){
           $file = __DIR__ . '/../App/View/admin/404.php'; 
        } else {
            $file = __DIR__ . '/../App/View/site/404.php'; 
        }
        
        http_response_code(404);
        if ( file_exists($file) ) {
            include __DIR__ . '/helpersView.php';
            include_once $file;
        } else {
            throw new \Exception('Arquivo View 404.php não existe');
        }
    }
    
}
