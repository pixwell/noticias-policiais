<?php

namespace Core;

use App\Model\User;

trait Authenticate
{
    private $userModel;
    private $redirectTo = '/admin';
    
    public function __construct(){
        $this->userModel = new User;
    }

    public function login()
    {
        $title = 'Login';
        echo $this->view( 'admin/login-form', compact('title') );
    }
    
    public function auth($request)
    {
        $campos = $request->post;
        //Se todos os campos estiverem preenchidos
        if( !empty($campos->login) && !empty($campos->password) ){
            $userData = $this->userModel->findWhere(['login', $campos->login]);
            //Achou algum login? Comparar as senhas
            if( $userData && password_verify($campos->password, $userData[0]->password) ){                
                //Autenticar
                 
                //Redirecionar
                echo json_encode([
                    'status' => true,
                    'mensagem' => '',
                    'redirect' => $this->redirectTo
                ]);
            } else {
                //Exibir mensagem de erro
                echo json_encode([
                    'status' => false,
                    'mensagem' => '<p class="status-fail">Login ou senha estão incorretos.</p>',
                    'redirect' => ''
                ]);
            }
        } else {
            //Se nao estiverem preenchidos
            echo '<p class="status-fail">Por favor preencha corretamente os campos do formulário.</p>';
        }
        
    }
}
