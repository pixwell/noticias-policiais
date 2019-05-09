<?php 
namespace App\Controller;

class NoticiaController
{
    public function index()
    {
        echo 'Hello world!';
    }

    public function show($id, $request)
    {
        echo "Show ID $id <br>";
        print_r($request);
    }
}
