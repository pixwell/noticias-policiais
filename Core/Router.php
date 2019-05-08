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
        //Se a URL tiver so a barra
        $url = empty(array_filter($urlArray)) ? '/' : $this->url;
        $routeFound = false;

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
                $route[0] = implode('/', $routeArray);
            }
            
            //Se a URL for igual à rota
            if( $url == $route[0] ){
                $routeFound = true;
                $controller = $route[1];
                $action = $route[2];
                break; //Sai do laco ao achar a rota
            }
        }
        
        //Se a rota foi encontrada acima
        if( $routeFound ){
            try {
                //Instancia o objeto
                $objController = Container::dispatcher($controller);
                //Chama a action
                $objController->$action();
            } catch (Exception $e) {
                echo $e->getMessage();
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