<?php

declare(strict_types=1);

namespace App\Middlewares\Middleware;

interface IMiddleware
{
    public function next(): bool;
}
