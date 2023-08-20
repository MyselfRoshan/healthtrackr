<?php

// Home

use App\Helper\PasswordResetToken;
use Database\Database;

$router->get('/', 'index.php')->only('guest');

// Signup
$router->get('/signup', 'signup/create.php')->only('guest');
$router->post('/signup', 'signup/store.php')->only('guest');


// Signin
$router->get('/signin', 'session/create.php')->only('guest');
$router->post('/signin', 'session/store.php')->only('guest');
$router->delete('/logout', 'session/destroy.php')->only('auth');

// Forgot Password
$router->get('/password-reset', 'passwordReset/create.php')->only('guest');
$router->post('/password-reset', 'passwordReset/store.php')->only('guest');
$router->get("/password-reset/{$session->reset_token}", 'passwordReset/new.php')->only('email');
$router->post("/password-reset/{$session->reset_token}", 'passwordReset/new.php')->only('email');

// User dashboard

if (isset($session->user)) {
    $router->get("/{$session->user['username']}", 'dashboard/index.php')->only('auth');
    $router->get("/{$session->user['username']}/profile", 'dashboard/profile.php')->only('auth');


    // $router->get("/{$_SESSION['user']['username']}", 'dashboard/index.php')->only('auth');
    // $router->get("/{$_SESSION['user']['username']}/profile", 'dashboard/profile.php')->only('auth');
}
