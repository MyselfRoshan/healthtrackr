<?php

$router->get('/', 'app/Http/Controllers/index.php');


$router->get('/signup', 'app/Http/Controllers/signup/create.php');
$router->post('/signup', 'app/Http/Controllers/signup/store.php');


$router->get('/signin', 'app/Http/Controllers/session/create.php');
$router->post('/signin', 'app/Http/Controllers/session/store.php');
$router->delete('/signin', 'app/Http/Controllers/session/destroy.php');

// For dasboard, profile, input make uri /username/dashboard

$router->get("/{$session->user}/dashboard", 'app/Http/Controllers/dashboard.php');
