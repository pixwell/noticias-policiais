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
        //Separa os itens da URL
        $urlArray = explode('/', $this->url);
        
        //Compara a URL com as rotas do sistema e substitui caso haja parametros
        foreach ($this->routes as $route) {
            $routeArray = explode('/', $this->routeFilter($route[0]));

            //Percorrendo cada item do $routeArray
            for ($i = 0; $i < count($routeArray); $i++) {
                //Se o item do $routeArray tiver '{' e tiver o mesmo tamanho de $urlArray
                if( (count($routeArray) == count($urlArray)) &&  (strpos($routeArray[$i], '{') !== false)){
                    //Substituindo o item {}
                    $routeArray[$i] = $urlArray[$i];
                    //Capturando os parametros
                    $param[] = $urlArray[$i];
                }
                //Montar a URL novamente, agora com o parametro
                $routeModified = implode('/', $routeArray);
            }
            //Se a URL for igual à rota
            if( $this->url == $routeModified ){
                echo '<b>Rota Modificada: </b>' . $routeModified . '<br>';
                echo '<b>Controller: </b>' . $route[1] . '<br>';
                echo '<b>Action: </b>' . $route[2] . '<hr>';
                echo '<b>Parametros: </b><br>';
                echo '<pre>' . var_dump($param) . '</pre><hr>';
                break; //Sai do laco ao achar a rota
            }
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