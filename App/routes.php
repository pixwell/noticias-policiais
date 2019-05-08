<?php

//Rotas da aplicacao
return [
    //['rota', 'controller', 'action'],
    ['/', 'NoticiasController', 'index'],
    ['/noticia/{id}/show', 'NoticiasController', 'singlePost'],
    ['/cidade/{id}/', 'NoticiasController', 'singlePost'],
    ['/{cidade}', 'NoticiasController', 'category'],
    ['{cidade}/{slug}/', 'NoticiasController', 'singlePost'],
];