<?php

namespace Core;

class Router
{
    private $url;

    public function __construct($urlBrowser)
    {
        $this->url = $urlBrowser;
    }

    public function run()
    {
        echo 'URL: ' . $this->url;
    }
}