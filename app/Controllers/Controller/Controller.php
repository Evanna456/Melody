<?php

namespace app\Controllers\Controller;

require __DIR__ . "/IController.php";

class Controller implements IController
{
    public function view($location)
    {
        $path = require '../views/' . $location;
        $path = ob_get_clean();
        return $path;
    }
}
