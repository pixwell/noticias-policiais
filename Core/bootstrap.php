<?php
$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_SPECIAL_CHARS);
$router = new \Core\Router($url);
$router->run();