<?php 
namespace App\Controller;

use Core\BaseController;

class NoticiaController extends BaseController
{
    public function index()
    {
        $title = 'Título da página';
        $nome = 'Marcia';
        echo $this->view( 'site/home', compact('title', 'nome') );
    }

    public function show($id, $request)
    {
        echo "Show ID $id <br>";
        print_r($request->post);
    }
}
