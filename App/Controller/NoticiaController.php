<?php 
namespace App\Controller;

class NoticiaController
{
    public function index()
    {
        include __DIR__ . '/../View/site/home.php'; 
    }

    public function show($id, $request)
    {
        echo "Show ID $id <br>";
        print_r($request->post);
    }
}
