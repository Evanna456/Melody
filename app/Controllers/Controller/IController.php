<?php

declare(strict_types=1);

namespace App\Controllers\Controller;

interface IController
{
    public function view(string $location);
    public function error404();
}
