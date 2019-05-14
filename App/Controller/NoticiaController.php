<?php 
namespace App\Controller;

use Core\BaseController;
use App\Model\Category;
use App\Model\Noticia;
use Ausi\SlugGenerator\SlugGenerator;

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
        $title = 'Notícias Policiais';
        $noticias = $this->modelNoticia->all();
        echo $this->view( 'site/home', compact('title', 'noticias') );
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
        //campos do formulario
        $campos = $request->post;
        //Gerador de slug
        $slugGenerator = new SlugGenerator;        
        $campos->slug = $slugGenerator->generate( strtolower($campos->title) );
        
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
