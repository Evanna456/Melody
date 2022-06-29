<?php

require_once __DIR__ . "/../app/Routing/Routing.php";

use App\Routing\Routing as Route;

Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware', 'throttle' => '60,1'], function () {
    Route::get("/", "PublicController@index");
    Route::get("/docs", "PublicController@docs");
});
