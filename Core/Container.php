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
    
    public static function pageNotFound()
    {
        $file = __DIR__ . '/../App/View/site/404.php';
        http_response_code(404);
        if ( file_exists($file) ) {
            include_once $file;
        } else {
            throw new \Exception('Arquivo View/site/404.php não existe');
        }
    }
    
    public static function pageNotFoundAdmin()
    {
        $file = __DIR__ . '/../App/View/admin/404.php';
        http_response_code(404);
        if ( file_exists($file) ) {
            include_once $file;
        } else {
            throw new \Exception('Arquivo View/admin/404.php não existe');
        }
    }
    
}
