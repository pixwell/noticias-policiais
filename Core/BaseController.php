<?php

namespace Core;

abstract class BaseController
{
    /**
     * Pasta de views
     */
    private $viewPath = __DIR__ . '/../App/View/';
    
    /**
     * Carrega as views
     *
     * @param  string $file
     * @param  array $variables
     *
     * @return void
     */
    protected function view($file, array $variables = null)
    {
        $filePath = $this->viewPath . $file . '.php';
        if( file_exists($filePath) ){
            $variables ? extract($variables) : null;
            $code_footer = $this->get_footer();
            include 'helpersView.php';
            include_once $filePath;
        } else {
            http_response_code(404);
            throw new \Exception("View não encontrada.");
        }
    }

}
