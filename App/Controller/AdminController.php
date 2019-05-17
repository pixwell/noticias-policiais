<?php

namespace App\Controller;

use Core\BaseController;

class AdminController extends BaseController
{
    public function index()
    {
        $metaTitle = 'Home Administração';
        echo $this->view('admin/home-admin', compact('metaTitle'));
    }
}
