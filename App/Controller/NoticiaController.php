<?php 
namespace App\Controller;

use Core\BaseController;
use App\Model\Category;
use App\Model\Noticia;
use Ausi\SlugGenerator\SlugGenerator;
use Core\Container;
use Core\Pagination;

class NoticiaController extends BaseController
{
    private $modelCategory;
    private $modelNoticia;
    private $pagination;
    private $settingsPagination;

    public function __construct(){
        $this->modelCategory = new Category;
        $this->modelNoticia = new Noticia;
        $this->pagination = new Pagination;
        $this->settingsPagination = $this->pagination->setPostPerPage(3);
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
    public function index($request)
    {
        //Config Paginacao
        $total = $this->modelNoticia->findWhere(['active', 1]);
        $currentPage = isset($request->get->page) ? $request->get->page : 1;
        $settingsPagination = $this->pagination->setCurrentPage($currentPage)->setTotalRecords(count($total));
        $navPaginacao = $settingsPagination->paginationLinks();
        //Noticias
        $metaTitle = 'Notícias Policiais';
        $categoryList = $this->categoryList();
        $noticias = $this->modelNoticia->findWhere(['active', 1], 'created_at DESC', "{$settingsPagination->limitStart()}, {$settingsPagination->getPostPerPage()}");
        echo $this->view( 'site/home', compact('metaTitle', 'noticias', 'categoryList', 'navPaginacao') );
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
        
        if($noticia){
            $metaTitle = $noticia[0]->title;
            $categoryList = $this->categoryList();
            echo $this->view( 'site/single', compact('metaTitle', 'noticia', 'categoryList') );
        } else {
            Container::pageNotFound();
        }
    }
    
    /**
     * Exibe as categorias de noticias
     * @param string $slug
     */
    public function category($slug, $request)
    {
        //Noticias
        $categoria = $this->modelCategory->findWhere(['slug', $slug]);
        $metaTitle = $categoria[0]->title;
        $total = $this->modelNoticia->findWhere( [['categories_id', $categoria[0]->id], ['active', 1]]);
        
        //Config Paginacao        
        $currentPage = isset($request->get->page) ? $request->get->page : 1;
        $settingsPagination = $this->pagination->setCurrentPage($currentPage)->setTotalRecords(count($total));
        $navPaginacao = $settingsPagination->paginationLinks();
        
        $noticias = $this->modelNoticia->findWhere( [['categories_id', $categoria[0]->id], ['active', 1]], 'created_at DESC', "{$settingsPagination->limitStart()}, {$settingsPagination->getPostPerPage()}" );
        
        echo $this->view( 'site/category', compact('metaTitle', 'noticias', 'categoria', 'navPaginacao') );
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
        
        if( !empty($campos->author) && !empty($campos->categories_id) && !empty($campos->title) && !empty($campos->content)){
            //Gerador de slug
            $slugGenerator = new SlugGenerator;        
            $campos->slug = $slugGenerator->generate( strtolower($campos->title) );
            $slugExiste = $this->modelNoticia->findWhere(['slug', $campos->slug]);
            $i = 0;
            
            if($slugExiste){
                do {
                    $i++;
                    $novoSlug = $campos->slug . '-' . $i;
                } while ( $this->modelNoticia->findWhere(['slug', $novoSlug]) );
                
                $campos->slug = $novoSlug;
            } 
            //Gravar no BD
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