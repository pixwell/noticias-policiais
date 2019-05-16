<?php

namespace App\Controller;

use Core\BaseController;
use App\Model\User;

class UserController extends BaseController
{
    private $userModel;
    
    public function __construct()
    {
        $this->userModel = new User;
    }
}
