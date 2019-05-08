<?php

//Rotas da aplicacao
return [
    //['rota', 'controller', 'action'],
    ['/', 'NoticiasController', 'index'],
    ['/noticia/{id}/show', 'NoticiasController', 'actionNoticias'],
    ['/cidade/{id}/', 'CidadeController', 'actionCidade'],
    ['/{slug}', 'slugController', 'actionSlug'],
];