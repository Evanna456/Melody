<?php

require_once __DIR__ . "/../app/Routing/Routing.php";

use App\Routing\Routing as Route;

Route::group(['middleware' => 'throttle:60,1', ['App\Http\Middleware\AdminMiddleware']], function () {
    Route::get("/", "PublicController@index");
    Route::get("/docs", "PublicController@docs");
});
