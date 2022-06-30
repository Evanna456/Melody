<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require '../app/Routing/Routing.php';
require '../routes/web.php';
