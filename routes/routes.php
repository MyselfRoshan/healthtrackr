<?php

$router->get('/', 'index.php')->only('guest');


$router->get('/signup', 'signup/create.php')->only('guest');
$router->post('/signup', 'signup/store.php')->only('guest');


$router->get('/signin', 'session/create.php')->only('guest');
$router->post('/signin', 'session/store.php')->only('guest');
$router->delete('/logout', 'session/destroy.php')->only('auth');

// For dasboard, profile, input make uri /username/dashboard

if (isset($session->user)) {
    $router->get("/{$session->user['username']}", 'dashboard/index.php')->only('auth');
    $router->get("/{$session->user['username']}/profile", 'dashboard/profile.php')->only('auth');


    // $router->get("/{$_SESSION['user']['username']}", 'dashboard/index.php')->only('auth');
    // $router->get("/{$_SESSION['user']['username']}/profile", 'dashboard/profile.php')->only('auth');
}
