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

    public function error(string $errorname): bool
    {
        if ($errorname == "403") {
            header('HTTP/1.0 403 Forbidden');
            return false;
        } else {
            return false;
        }
    }
}
