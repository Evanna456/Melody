<?php

declare(strict_types=1);

namespace App\Middlewares;

require __DIR__ . "/Controller/Controller.php";

use App\Middlewares\Middleware\Middleware;

class PublicMiddlware extends Middleware
{
    public function handle()
    {
        Middleware::next();
    }
}
