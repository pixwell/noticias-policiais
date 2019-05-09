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
            $code_head = $this->get_header();
            $code_footer = $this->get_footer();
            include_once $filePath;
        } else {
            http_response_code(404);
            throw new \Exception("View não encontrada.");
        }
    }
    
    private function get_header()
    {
        $headCode = __DIR__ . '/../App/View/code_head.php';

        if( file_exists($headCode) ){
            return file_get_contents($headCode);
        } else {
            throw new \Exception("Arquivo View/code_head.php não encontrado.");
        }
    }

    private function get_footer()
    {
        $footerCode = __DIR__ . '/../App/View/code_footer.php';

        if( file_exists($footerCode) ){
            return file_get_contents($footerCode);
        } else {
            throw new \Exception("Arquivo View/code_footer.php não encontrado.");
        }
    }
}
