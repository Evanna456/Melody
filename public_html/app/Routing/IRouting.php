<?php

declare(strict_types=1);

namespace App\Routing;

interface IRouting
{
    public function get(string $route, string $call): void;
    public function route(string $route, string $call): void;
}
