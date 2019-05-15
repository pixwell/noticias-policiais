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
    
    public function categoryList(){
        $list = $this->modelCategory->all();
        foreach ($list as $value) {
            $newList[$value->id] = [
                'title' => $value->title,
                'slug' => $value->slug
            ];
        }
        return $newList;
    }

    public function index()
    {
        $title = 'Notícias Policiais';
        $noticias = $this->modelNoticia->all();
        $categoryList = $this->categoryList();
        echo $this->view( 'site/home', compact('title', 'noticias', 'categoryList') );
    }

    public function show($slug)
    {
        //Padrao where: [0 => 'campo', 1 => 'valor', 2 => 'operador'];
        $query = ['slug', $slug];
        
        $noticia = $this->modelNoticia->findWhere($query);
        $title = $noticia[0]->title;
        $categoryList = $this->categoryList();
        
        echo $this->view( 'site/single', compact('title', 'noticia', 'categoryList') );
    }
    
    public function category($slug)
    {
        //Padrao where: [0 => 'campo', 1 => 'valor', 2 => 'operador'];    
        $categoria = $this->modelNoticia->findWhere(['slug', $slug]);        
        $title = $categoria[0]->title;
        
        echo $this->view( 'site/category', compact('title', 'categoria') );
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
