<?php

namespace Core;

trait Authenticate
{
    private $redirectTo = '/admin';
    protected $salt = '?%#tzT$30XnC$NMM/WgTho;DHIUV4z2XR@E?-/g}{Q[vCY;/Za[>^m1P0o=@=}6R';
    
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
