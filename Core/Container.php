<?php

namespace Core;

class Container
{
    public static function dispatcher($controller)
    {
        $instancia = 'App\\Controller\\' . $controller;
        return new $instancia;
    }
}
