<?php

namespace Core;

abstract class BaseController
{
    private $viewPath = __DIR__ . '/../App/View/';
    protected $head = __DIR__ . '/../App/View/code_head.php';
    protected $footer = __DIR__ . '/../App/View/code_footer.php';

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
        if( file_exists($this->head) ){
            return $this->head;
        } else {
            throw new \Exception("Arquivo View/code_head.php não encontrado.");
        }
    }

    private function get_footer()
    {
        if( file_exists($this->footer) ){
            return $this->footer;
        } else {
            throw new \Exception("Arquivo View/code_footer.php não encontrado.");
        }
    }
}
