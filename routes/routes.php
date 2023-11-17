<?php

// Home
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
    // Add
    $router->get("/{$session->user['username']}/add", 'user/add.php')->only('auth');

    $router->get("/{$session->user['username']}/add/daily-exercise", 'user/daily-exercise/create.php')->only('auth');
    $router->get("/{$session->user['username']}/add/daily-exercise/data", 'user/daily-exercise/data.php')->only('auth');
    $router->post("/{$session->user['username']}/add/daily-exercise", 'user/daily-exercise/store.php')->only('auth');

    $router->get("/{$session->user['username']}/add/stay-hydrated", 'user/stay-hydrated/create.php')->only('auth');
    $router->get("/{$session->user['username']}/add/stay-hydrated/data", 'user/stay-hydrated/data.php')->only('auth');
    $router->post("/{$session->user['username']}/add/stay-hydrated", 'user/stay-hydrated/store.php')->only('auth');

    $router->get("/{$session->user['username']}/add/balanced-nutrition", 'user/balanced-nutrition.php')->only('auth');
    // $router->post("/{$session->user['username']}/add/balanced-nutrition", 'user/balanced-nutrition.php')->only('auth');

    $router->get("/{$session->user['username']}/add/quality-sleep", 'user/quality-sleep/create.php')->only('auth');
    $router->get("/{$session->user['username']}/add/quality-sleep/data", 'user/quality-sleep/data.php')->only('auth');
    $router->post("/{$session->user['username']}/add/quality-sleep", 'user/quality-sleep/store.php')->only('auth');

    // Profile
    $router->get("/{$session->user['username']}", 'user/index.php')->only('auth');
    $router->get("/{$session->user['username']}/profile", 'user/profile/create.php')->only('auth');
    $router->post("/{$session->user['username']}/profile", 'user/profile/store.php')->only('auth');


    $router->get("/{$session->user['username']}/reminder", 'user/reminder.php')->only('auth');
    $router->get("/{$session->user['username']}/goal", 'user/goal.php')->only('auth');
}
