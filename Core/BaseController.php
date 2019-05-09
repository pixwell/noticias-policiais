<?php

namespace Core;

abstract class BaseController
{
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
            include_once $filePath;
        } else {
            http_response_code(404);
            throw new \Exception("View não encontrada.");
        }
    }
}
