<?php

namespace Core;

abstract class BaseController
{
    private $viewPath = __DIR__ . '/../App/View/';

    protected function view($file, $variables = null)
    {
        $filePath = $this->viewPath . $file . '.php';
        if( file_exists($filePath) ){
            include_once $filePath;
        } else {
            \http_response_code(404);
            throw new \Exception("View não encontrada.");
        }
    }
}
