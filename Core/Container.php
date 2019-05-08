<?php

namespace Core;

class Container
{
    public static function dispatcher($controller)
    {
        $classe = 'App\\Controller\\' . $controller;
        return new $classe;
    }
}
