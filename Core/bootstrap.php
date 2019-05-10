<?php
$site_root = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
define('ASSETS', $site_root);
//Arquivo de rotas da aplicacao
$routes = require_once __DIR__ . '/../App/routes.php';
//Capturando a URL do browser
$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_SPECIAL_CHARS);
//Router(URLBrowser, Rotas);
$router = new \Core\Router($url, $routes);
$router->run();