<?php

namespace App\Controller;

use Core\BaseController;
use Core\Session;
use App\Model\Noticia;
use App\Model\Category;
use Core\Container;
use Core\Pagination;


class AdminController extends BaseController
{
    private $noticiasModel;
    private $modelCategory;
    private $pagination;
    private $numberPages = 5;


    public function __construct() {
        $this->noticiasModel = new Noticia;
        $this->modelCategory = new Category;
        $this->pagination = new Pagination;
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
    
    public function index($request)
    {
        $metaTitle = 'Home Administração';
        $currentPage = isset($request->get->page) ? $request->get->page : 1;
        $noticias = $this->noticiasModel->all('created_at DESC', "$currentPage, $this->numberPages");
        $categoryList = $this->categoryList();
        $navPaginacao = $this->pagination->setCurrentPage($currentPage)->setPostPerPage($this->numberPages)->paginationLinks();
        echo $this->view('admin/home-admin', compact('metaTitle', 'noticias', 'categoryList', 'navPaginacao'));
    }
    
    /**
     * Exibe as paginas single
     * @param string $slug
     */
    public function show($slug)
    {
        //Padrao where: [0 => 'campo', 1 => 'valor', 2 => 'operador'];
        $query = ['slug', $slug];        
        $noticia = $this->noticiasModel->findWhere($query);       
        
        if($noticia){
            $metaTitle = $noticia[0]->title;
            $categoryList = $this->categoryList();
            echo $this->view( 'admin/single-admin', compact('metaTitle', 'noticia', 'categoryList') );            
        } else {
            Container::pageNotFound(true);
        }        
    }
    
    public function toggleActive($id){
        $noticia = $this->noticiasModel->find($id);
        if($noticia && $noticia->active == 0){
            $update = $this->noticiasModel->update($id, ['active' => 1]);
            echo json_encode([
                'class' => 'btn-processing',
                'content' => '<svg><use href="#checkbox" /></svg> Aprovado'
            ]);
        } elseif($noticia && $noticia->active == 1){
            $update = $this->noticiasModel->update($id, ['active' => 0]);
            echo json_encode([
                'class' => 'btn-success',
                'content' => '<svg><use href="#checkbox" /></svg> Aprovar'
            ]);
        }
    }
    
    public function delete($id){
        return $this->noticiasModel->delete($id);
    }
}
