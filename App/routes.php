<?php

//Rotas da aplicacao
return [
    //['rota', 'controller', 'action'],
    ['/', 'NoticiaController', 'index'],
    ['registrar-ocorrencia', 'NoticiaController', 'create'],
    ['store-ocorrencia', 'NoticiaController', 'store'],
    //Autenticacao
    ['login', 'UserController', 'login'],
    ['auth', 'UserController', 'auth'],
    ['create-user', 'UserController', 'createUser'],
    
    ['admin', 'AdminController', 'index'],
    ['cidade/{slug}', 'NoticiaController', 'category'],
    ['{slug}', 'NoticiaController', 'show'],
];