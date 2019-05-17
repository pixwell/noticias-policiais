<?php

namespace App\Controller;

use Core\BaseController;
use Core\Session;
use App\Model\Noticia;

class AdminController extends BaseController
{
    private $noticiasModel;
    
    public function __construct() {
        $this->noticiasModel = new Noticia;
    }
    
    public function index()
    {
        $metaTitle = 'Home Administração';
        $sessao = Session::get('user');
        echo $this->view('admin/home-admin', compact('metaTitle', 'sessao'));
    }
}
