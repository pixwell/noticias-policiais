<?php 
namespace App\Controller;

use Core\BaseController;
use App\Model\Category;
use App\Model\Noticia;

class NoticiaController extends BaseController
{
    private $modelCategory;
    private $modelNoticia;

    public function __construct(){
        $this->modelCategory = new Category;
        $this->modelNoticia = new Noticia;
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
        $campos = $request->post;
        if( !empty($campos->author) && !empty($campos->categories_id) && !empty($campos->title) && !empty($campos->content)){
            $gravar = $this->modelNoticia->insert($campos);
            if($gravar){
                echo '<p class="status-success">Ocorrência enviada com sucesso!</p>';
            } else {
                echo '<p class="status-fail">Erro ao enviar ocorrência.</p>';
            }
        } else {
            echo 'Erro! Por favor preencha os campos do formulário corretamente.';
        }
    }
}
