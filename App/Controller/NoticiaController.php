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
    
    /**
     * Reorganiza a lista de categorias, deixando o ID como chave em cada item
     * @return array
     */
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
    
    /**
     * Noticias da Home organizadas por datas e filtradas por estado ativo
     */
    public function index()
    {
        $metaTitle = 'Notícias Policiais';
        $noticias = $this->modelNoticia->findWhere(['active', 1], 'created_at DESC');
        $categoryList = $this->categoryList();
        echo $this->view( 'site/home', compact('metaTitle', 'noticias', 'categoryList') );
    }
    
    /**
     * Exibe as paginas single
     * @param string $slug
     */
    public function show($slug)
    {
        //Padrao where: [0 => 'campo', 1 => 'valor', 2 => 'operador'];
        $query = ['slug', $slug];
        
        $noticia = $this->modelNoticia->findWhere($query);
        $metaTitle = $noticia[0]->title;
        $categoryList = $this->categoryList();
        
        echo $this->view( 'site/single', compact('metaTitle', 'noticia', 'categoryList') );
    }
    
    /**
     * Exibe as categorias de noticias
     * @param string $slug
     */
    public function category($slug)
    {
        //Padrao where: [0 => 'campo', 1 => 'valor', 2 => 'operador'];    
        $categoria = $this->modelCategory->findWhere(['slug', $slug]);
        $noticias = $this->modelNoticia->findWhere( [['categories_id', $categoria[0]->id], ['active', 1]], 'created_at DESC' );
        $metaTitleCategoria = $categoria[0]->title;
        $metaTitle = '';
        
        echo $this->view( 'site/category', compact('metaTitle', 'noticias', 'categoria', 'titleCategoria') );
    }

    /**
     * Exibe o formulario de registro de ocorrencias
     */
    public function create()
    {
        $metaTitle = 'Enviar ocorrência';
        $cidades = $this->modelCategory->all();
        $ultimas = $this->modelNoticia->findWhere(['active', 1], 'created_at DESC', 4);
        echo $this->view( 'site/form', compact('metaTitle', 'cidades', 'ultimas') );
    }
    
    /**
     * Grava os registros no banco de dados
     * @param object $request
     */
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
        }//if
    }
}
