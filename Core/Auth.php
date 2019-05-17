<?php

namespace Core;

class Auth {
    private $id;
    private $name;
    private $login;
    
    public function __construct()
    {
        if(Session::get('user')){
            $user = Session::get('user');
            $this->id = $user['id'];
            $this->name = $user['name'];
            $this->login = $user['login'];
        }
    }
    
    public function id()
    {
        return $this->id;
    }
    
    public function name()
    {
        return $this->name;
    }
    
    public function login()
    {
        return $this->login;
    }
    
    public function check()
    {
        if( $this->id == null || $this->name == null || $this->login == null ){
            return true;
        } else {
            return false;
        }
    }
}
