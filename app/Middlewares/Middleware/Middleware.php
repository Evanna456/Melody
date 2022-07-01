<?php

declare(strict_types=1);

namespace App\Middlewares\Middleware;

require __DIR__ . "/IMiddleware.php";

class Middleware implements IMiddleware
{
    public function next(): bool
    {
        return true;
    }
}
