<?php

use App\Router;
use App\Session;

const BASE_PATH = __DIR__ . "/../";
require BASE_PATH . "config/bootstrap.php";

// Signin the user automatically if cookie is set but Session isn't
$session = Session::getInstance();
if (!isset($session->user) && isset($_COOKIE['remember_me'])) {
    $session->startSession();
    $session->user = json_decode($_COOKIE['remember_me'], true);
}

$router = new Router();
$routes = require base_path("routes/routes.php");
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_request_method'] ?? $_SERVER['REQUEST_METHOD'];
$router->route($uri, $method);

// Database::select()