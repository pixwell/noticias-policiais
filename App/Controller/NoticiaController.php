<?php 
namespace App\Controller;

use Core\BaseController;

class NoticiaController extends BaseController
{
    public function index()
    {
        echo $this->view('site/home');
    }

    public function show($id, $request)
    {
        echo "Show ID $id <br>";
        print_r($request->post);
    }
}
