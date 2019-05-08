<?php

//Rotas da aplicacao
return [
    //['rota', 'controller@action'],
    ['/', 'NoticiasController@index'],
    ['/{cidade}', 'NoticiasController@category'],
    ['{cidade}/{slug}/', 'NoticiasController@singlePost'],
    ['/noticia/{slug}/', 'NoticiasController@singlePost'],
    ['/cidade/{id}/', 'NoticiasController@singlePost'],
];