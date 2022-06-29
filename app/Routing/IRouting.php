<?php

declare(strict_types=1);

namespace App\Routing;

interface IRouting
{
    public static function get(string $route, string $call): void;
    public static  function route(string $route, string $call): void;
    public static function group($middleware, $function): void;
}
