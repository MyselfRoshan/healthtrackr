<?php

$router->get('/', 'app/Http/Controllers/index.php');
$router->get('/signup', 'app/Http/Controllers/signup.php');
$router->get('/signin', 'app/Http/Controllers/signin.php');

// For dasboard, profile, input make uri /username/dashboard
$router->get('/dashboard', 'app/Http/Controllers/dashboard.php');
