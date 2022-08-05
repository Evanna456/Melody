<?php

declare(strict_types=1);

namespace App\Routing;

require __DIR__ . "/IRouting.php";

class Routing implements IRouting
{
    public static bool $file = false;

    public static function get(string $route, string $call): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            Routing::route($route, $call);
        }
    }

    public static function route(string $route, string $call_function): void
    {
        $route_dict = [];
        $route_dict[$route] = $call_function;
        $request_url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
        foreach ($route_dict as $key => $value) {
            if ($request_url == $key) {
                $controller = $route_dict[$key];
                $controller_parts = explode("@", $controller);
                $class = $controller_parts[0];
                $function = $controller_parts[1];
                require_once __DIR__ . "/../Controllers/" . $class . ".php";
                $Class = "App\Controllers\\" . $class;
                $Class = new $Class;
                $Class->$function();
                Routing::$file =  true;
                exit;
            }
        }
    }

    public static function check()
    {
        if (Routing::$file == false) {
            require_once __DIR__ . "/../Controllers/Controller/Controller.php";
            $Controller = "App\Controllers\Controller\Controller";
            $Controller = new $Controller;
            $Controller->error404();
            exit;
        }
    }

    public static function group($middleware, $function): void
    {
        Routing::ratelimit($middleware, $function);
    }

    public static function ratelimit($group, $function): void
    {
        $throttle_parts = explode(",", $group["throttle"]);
        $middleware = $group["middleware"];
        if (isset($_SESSION["X-RateLimit-Limit"]) == true && isset($_SESSION["X-RateLimit-Remaining"]) == true) {
            $_SESSION["X-RateLimit-Remaining"] =  $_SESSION["X-RateLimit-Remaining"] - 1;
            header("X-RateLimit-Limit: " . $_SESSION["X-RateLimit-Limit"]);
            header("X-RateLimit-Remaining: " . $_SESSION["X-RateLimit-Remaining"]);
            if (time() < $_SESSION["X-RateLimit-Expiry"]) {
                if ($_SESSION["X-RateLimit-Remaining"] > 0) {
                    Routing::middleware($middleware, $function);
                } else if ($_SESSION["X-RateLimit-Remaining"] < 0) {
                    $seconds = $_SESSION["X-RateLimit-Expiry"] - time();
                    sleep($seconds);
                }
            } else if (time() > $_SESSION["X-RateLimit-Expiry"]) {
                $_SESSION["X-RateLimit-Limit"] = $throttle_parts[0];
                $_SESSION["X-RateLimit-Remaining"] = $throttle_parts[0];
                $_SESSION["X-RateLimit-Expiry"] = time() + $throttle_parts[1] * 60;
                Routing::middleware($middleware, $function);
            }
        } else {
            $_SESSION["X-RateLimit-Limit"] = $throttle_parts[0];
            $_SESSION["X-RateLimit-Remaining"] = $throttle_parts[0];
            $_SESSION["X-RateLimit-Expiry"] = time() + $throttle_parts[1] * 60;
            header("X-RateLimit-Limit: " . $_SESSION["X-RateLimit-Limit"]);
            header("X-RateLimit-Remaining: " . $_SESSION["X-RateLimit-Remaining"]);
            Routing::middleware($middleware, $function());
        }
    }

    public static function middleware($middleware, $function): void
    {
        $middleware_parts = explode("\\", $middleware);
        require_once __DIR__ . "/../Middlewares/" . $middleware_parts[2] . ".php";
        $Middleware = $middleware;
        $Middleware = new $Middleware;
        $allow = $Middleware->handle();
        if ($allow == true) {
            $function();
        } else if ($allow == false) {
            require_once __DIR__ . "/../Controllers/Controller/Controller.php";
            $Controller = "App\Controllers\Controller\Controller";
            $Controller = new $Controller;
            $Controller->error403();
            exit;
        }
    }
}
