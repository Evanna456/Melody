<?php

declare(strict_types=1);

namespace App\Middlewares;

require __DIR__ . "/Middleware/Middleware.php";

use App\Middlewares\Middleware\Middleware;

class PublicMiddleware extends Middleware
{
    public function handle()
    {
        //Middleware::next();
        Middleware::error("403");
    }
}
