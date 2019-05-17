<?php

namespace App\Controller;

use Core\BaseController;
use Core\Session;
use App\Model\Noticia;
use App\Model\Category;


class AdminController extends BaseController
{
    private $noticiasModel;
    private $modelCategory;
    
    public function __construct() {
        $this->noticiasModel = new Noticia;
        $this->modelCategory = new Category;
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
    
    public function index()
    {
        $metaTitle = 'Home Administração';
        $noticias = $this->noticiasModel->all('created_at DESC');
        $categoryList = $this->categoryList();
        echo $this->view('admin/home-admin', compact('metaTitle', 'noticias', 'categoryList'));
    }
}
