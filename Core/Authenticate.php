<?php

namespace Core;

trait AuthController
{
    private $redirectTo = '/admin';
    
    public function login()
    {
        $title = 'Login';
        echo $this->view( 'admin/login-form', compact('title') );
    }
    
    public function auth($request)
    {
        $campos = $request->post;
        
        if( !empty($campos->login) &&!empty($campos->password) ){
            echo json_encode([
                'status' => true,
                'redirect' => $this->redirectTo
            ]);
        }
    }
}
