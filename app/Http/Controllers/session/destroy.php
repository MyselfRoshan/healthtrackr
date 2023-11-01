<?php

use App\Session;
// use Database\Database;

$session = Session::getInstance();

// Update user last login
// $query = "UPDATE public.user
// SET last_login = CURRENT_TIMESTAMP
// WHERE email = :email";
// $params = [
//     "email" => [$session->user['email'], PDO::PARAM_STR]
// ];
// Database::update($query, $params);

// Destory session and cookies
$session->destroy();

$params = session_get_cookie_params();
setcookie(
    'PHPSESSID',
    '',
    time() - 3333,
    $params['path'],
    $params['domain'],
    $params['secure'],
    $params['httponly']
);
setcookie(
    'remember_me',
    '',
    time() - 3333,
    $params['path'],
    $params['domain'],
    $params['secure'],
    $params['httponly']
);

redirect('/');
