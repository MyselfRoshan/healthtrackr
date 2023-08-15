<?php

use App\Session;

$session = Session::getInstance();
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
