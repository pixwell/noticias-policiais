<?php

namespace App\Controller;

use Core\BaseController;
use Core\Authenticate;
use App\Model\User;

class UserController extends BaseController
{
    use Authenticate;
    
    private $userModel;
    private $salt = '?%#tzT$30XnC$NMM/WgTho;DHIUV4z2XR@E?-/g}{Q[vCY;/Za[>^m1P0o=@=}6R';
    
    public function __construct()
    {
        $this->userModel = new User;
    }
}
