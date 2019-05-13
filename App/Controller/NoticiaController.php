<?php 
namespace App\Controller;

use Core\BaseController;
use App\Model\Category;

class NoticiaController extends BaseController
{
    private $modelCategory;

    public function __construct(){
        $this->modelCategory = new Category;
    }

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

    public function create()
    {
        $title = 'Enviar ocorrência';
        $cidades = $this->modelCategory->all();
        echo $this->view( 'site/form', compact('title', 'cidades') );
    }

    public function store($request)
    {
        var_dump($request);
    }
}
