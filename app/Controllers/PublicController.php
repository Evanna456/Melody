<?php

require __DIR__ . "/Controller/Controller.php";

class PublicController extends Controller
{
    public function index()
    {
        $Controller = new Controller;
        return $Controller->view('index.php');
    }

    public function docs()
    {
        $Controller = new Controller;
        return $Controller->view('docs.php');
    }

    public function error403()
    {
        $Controller = new Controller;
        return $Controller->view('errors/error403.php');
    }
    public function error404()
    {
        $Controller = new Controller;
        return $Controller->view('errors/error404.php');
    }
}
