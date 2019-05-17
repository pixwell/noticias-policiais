<?php

namespace App\Controller;

use Core\BaseController;
use Core\Session;

class AdminController extends BaseController
{
    public function index()
    {
        $metaTitle = 'Home Administração';
        $sessao = Session::get('user');
        echo $this->view('admin/home-admin', compact('metaTitle', 'sessao'));
    }
}
