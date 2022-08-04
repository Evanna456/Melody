<?php

declare(strict_types=1);

namespace App\Controllers\Controller;

require __DIR__ . "/IController.php";

class Controller implements IController
{
    public function view(string $location)
    {
        $path = require '../views/' . $location;
        return $path;
    }

    public function error404()
    {
        $path = require '../views/errors/error404.php';
        return $path;
    }
    public function error403()
    {
        $path = require '../views/errors/error403.php';
        return $path;
    }
}
