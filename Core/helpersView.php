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
//USER ==================================
function auth_check(){
    $user = new \Core\Auth;
    return $user->check();
}

function user_name(){
    $user = new \Core\Auth;
    return $user->name();
}

function user_login(){
    $user = new \Core\Auth;
    return $user->login();
}

function user_id(){
    $user = new \Core\Auth;
    return $user->id();
}
//PAGINACAO ==================================
function paginationLinks(){
    $pagination = new \Core\Pagination;
    return $pagination->paginationLinks();
}

/**
* Inclusao do codigo no header da view
* Do <html> ate abertura do <body>
*
* @return void
*/
function get_head($title = null) {
    $head = __DIR__ . '/../App/View/code_head.php';
    if (file_exists($head)) {
        $metaTitle = $title;
        include $head;
    } else {
        throw new \Exception("Arquivo View/code_head.php não encontrado.");
    }
}

/**
 * Inclusao dos scripts JS, fechamento das tags </body> e </html>
 *
 * @return void
 */
function get_footer() {
    $footer = __DIR__ . '/../App/View/code_footer.php';
    if (file_exists($footer)) {
        include $footer;
    } else {
        throw new \Exception("Arquivo View/code_footer.php não encontrado.");
    }
}
