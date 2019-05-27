<?php

//Rotas da aplicacao
return [
    //['rota', 'controller', 'action', 'auth'],
    ['/', 'NoticiaController', 'index'],
    ['registrar-ocorrencia', 'NoticiaController', 'create'],
    ['store-ocorrencia', 'NoticiaController', 'store'],
    //Autenticacao
    ['login', 'UserController', 'login'],
    ['logout', 'UserController', 'logout'],
    ['auth', 'UserController', 'auth'],
    
    //Rotas para criacao de usuarios, elas nao estao protegidas por login e senha!
    //['create-user', 'UserController', 'createUser'],
    //['store-user', 'UserController', 'storeUser'],
    
    ['admin', 'AdminController', 'index', 'auth'],
    ['admin/{id}/change-status/', 'AdminController', 'toggleActive', 'auth'],
    ['admin/{id}/delete/', 'AdminController', 'delete', 'auth'],
    ['admin/{slug}', 'AdminController', 'show', 'auth'],
    ['cidade/{slug}', 'NoticiaController', 'category'],
    ['{slug}', 'NoticiaController', 'show'],
];