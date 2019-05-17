<?php

namespace Core;

class Auth {
    private $id;
    private $name;
    private $login;
    
    public function __construct()
    {
        $user = Session::get('user');
        if($user){
            $this->id = $user['id'];
            $this->name = $user['name'];
            $this->login = $user['login'];
        }
    }
    
    public static function id()
    {
        return self::$id;
    }
    
    public static function name()
    {
        return self::$name;
    }
    
    public static function login()
    {
        return self::$login;
    }
    
    public static function check()
    {
        if( self::$id == null || self::$name == null || self::$login == null ){
            return true;
        } else {
            return false;
        }
    }
}
