<?php

require __DIR__ . "/../app/Controllers/PublicController.php";

use Pecee\SimpleRouter\SimpleRouter;
use Pecee\Http\Request;
use app\Controllers\PublicController;

SimpleRouter::get('/', [PublicController::class, 'index']);
SimpleRouter::get('/docs', [PublicController::class, 'docs']);
SimpleRouter::get('/not-found', [PublicController::class, 'error404']);
SimpleRouter::get('/forbidden', [PublicController::class, 'error403']);

SimpleRouter::error(function (Request $request, \Exception $exception) {

    switch ($exception->getCode()) {
            // Page not found
        case 404:
            response()->redirect('/not-found');
            // Forbidden
        case 403:
            response()->redirect('/forbidden');
    }
});

// Start the routing
SimpleRouter::start();
