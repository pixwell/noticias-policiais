<?php

namespace Core;

abstract class BaseController
{
    /**
     * Pasta de views
     */
    private $viewPath = __DIR__ . '/../App/View/';
    /**
     * Arquivo com a marcacao HTML do cabecalho da view
     */
    protected $head = __DIR__ . '/../App/View/code_head.php';
    /**
     * Arquivo com os scripts JS e fechamento do <body> e <html>
     */
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
            include 'helpersView.php';
            include_once $filePath;
        } else {
            http_response_code(404);
            throw new \Exception("View não encontrada.");
        }
    }
    
    /**
     * Inclusao do codigo no header da view
     * Do <html> ate abertura do <body>
     *
     * @return void
     */
    private function get_header()
    {
        if( file_exists($this->head) ){
            return $this->head;
        } else {
            throw new \Exception("Arquivo View/code_head.php não encontrado.");
        }
    }

    /**
     * Inclusao dos scripts JS, fechamento das tags </body> e </html>
     *
     * @return void
     */
    private function get_footer()
    {
        if( file_exists($this->footer) ){
            return $this->footer;
        } else {
            throw new \Exception("Arquivo View/code_footer.php não encontrado.");
        }
    }
}
