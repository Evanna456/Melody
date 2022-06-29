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
}
