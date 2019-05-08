<?php

//Rotas da aplicacao
return [
    //['rota', 'controller', 'action'],
    ['/', 'NoticiaController', 'index'],
    ['noticia/{id}/show', 'NoticiaController', 'show'],
    ['cidade/{id}', 'CidadeController', 'actionCidade'],
    ['{slug}', 'slugController', 'actionSlug'],
];