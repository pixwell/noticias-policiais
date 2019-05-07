<?php

namespace Core;

class Router
{
    private $url;
    private $routes;

    public function __construct($urlBrowser, array $appRoutes)
    {
        $this->url = $urlBrowser;
        $this->routes = $appRoutes;
    }

    public function run()
    {
        $urlArray = explode('/', $this->url);
        echo 'URL: ';
        print_r($urlArray);
        echo '<hr>';

        foreach ($this->routes as $route) {
            echo 'Route: <br>';
            print_r($route);
            echo '<br>' . $this->routeFilter($route[0]);
            echo '<hr>';
        }
    }
    
    /**
     * Retira barra no inicio e final da rota
     *
     * @param string $rota
     * @return string
     */
    private function routeFilter($rota){
        $slashBegin = '/^[\/]+/';
        $slashEnd = '/[\/]+$/';

        //Se a rota for diferente de '/' (home)
        if( $rota != '/' ){
            //Verifica se tem barra no comeco e retira
            if( preg_match($slashBegin, $rota) ){
                $rota = substr_replace ($rota , '', 0, 1) ;
            }
            //Verifica se tem barra no final e retira
            if( preg_match($slashEnd, $rota) ){
                $rota = substr_replace ($rota , '', (strlen($rota)-1), strlen($rota)) ;
            }
        }
        return $rota;
    }
}