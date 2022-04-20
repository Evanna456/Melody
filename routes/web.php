<?php

require_once __DIR__ . "/../app/Routing/Routing.php";

use App\Routing\Routing;

$route = new Routing;

$route->get("/", "PublicController@index");
$route->get("/docs", "PublicController@docs");
