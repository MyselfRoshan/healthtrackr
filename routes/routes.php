<?php

$router->get('/', 'index.php');


$router->get('/signup', 'signup/create.php')->only('guest');
$router->post('/signup', 'signup/store.php')->only('guest');


$router->get('/signin', 'session/create.php')->only('guest');
$router->post('/signin', 'session/store.php')->only('guest');
$router->delete('/signin', 'session/destroy.php')->only('auth');

// For dasboard, profile, input make uri /username/dashboard

$router->get("/dashboard", 'dashboard.php')->only('auth');
// $router->get("/{$session->user}/dashboard", 'dashboard.php')->only('auth');
