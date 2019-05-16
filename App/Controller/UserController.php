<?php

namespace App\Controller;

use Core\BaseController;
use Core\Authenticate;
use App\Model\User;

class UserController extends BaseController
{
    use Authenticate;
    
    private $userModel;
    
    public function __construct()
    {
        $this->userModel = new User;
    }
    
    public function createUser()
    {
        $title = 'Criar Usuário';
        echo $this->view( 'admin/create-user', compact('title') );        
    }
    
    public function storeUser($request)
    {
        $campos = $request->post;
        
        if( !empty($campos->login) &&!empty($campos->password) ){
            //Senha temperada
            $campos->password = password_hash($campos->password, PASSWORD_BCRYPT);      
            $storeUser = $this->userModel->insert($campos);
            
            if($storeUser){
                echo json_encode([
                    'mensagem' => '<p class="status-success">Usuário criado com sucesso!</p>',
                    'status' => true
                ]);
            } else {
                echo json_encode([
                    'mensagem' => '<p class="status-fail">Erro ao criar usuário.</p>',
                    'status' => false
                ]);
            }
        } else {
            echo 'Erro! Por favor preencha os campos do formulário corretamente.';
        }//if
    }
}
