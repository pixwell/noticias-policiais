<?php

function limita_texto($texto, $numChar = 40, $dot = true, $echo = true){
    $reticencia = ($dot == true) ? ' ...' : '';
    $resumo = strlen($texto) > $numChar ? substr($texto, 0, $numChar) . $reticencia : $texto;
    if($echo){
       echo $resumo;
    } else {
        return $resumo;
    }    
}

function auth_check(){
    return \Core\Auth::check();
}

function user_name(){
    return \Core\Auth::name();
}
