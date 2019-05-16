<?php

namespace App\Controller;

use Core\BaseController;

class AuthController extends BaseController {
    public function login()
    {
        $title = 'Login';
        echo $this->view( 'admin/login-form', compact('title') );
    }
    public function auth()
    {
      echo 'Método Auth'; 
    }
}
