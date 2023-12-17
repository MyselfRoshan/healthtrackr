<?php

// Home
$router->get('/', 'index.php')->only('guest');

// Signup
$router->get('/signup', 'signup/create.php')->only('guest');
$router->post('/signup', 'signup/store.php')->only('guest');


// Signin
$router->get('/signin', 'session/create.php')->only('guest');
$router->post('/signin', 'session/store.php')->only('guest');
$router->get('/signin/admin', 'admin/session/create.php')->only('guest');
$router->post('/signin/admin', 'admin/session/store.php')->only('guest');
$router->delete('/logout', 'session/destroy.php')->only('auth');
$router->delete('/admin/logout', 'admin/session/destroy.php')->only('admin');

// Forgot Password
$router->get('/password-reset', 'passwordReset/create.php')->only('guest');
$router->post('/password-reset', 'passwordReset/store.php')->only('guest');
$router->get("/password-reset/{$session->reset_token}", 'passwordReset/new.php')->only('email');
$router->post("/password-reset/{$session->reset_token}", 'passwordReset/new.php')->only('email');

// Admin

if (isset($session->user) && $session->is_admin) {

    $router->get('/admin', 'admin/index.php')->only('admin');
    $router->get('/admin/user', 'admin/user/index.php')->only('admin');

    // Edit User
    $router->get('/admin/user/edit', 'admin/user/edit/create.php')->only('admin');
    $router->put('/admin/user/edit', 'admin/user/edit/update.php')->only('admin');
    $router->patch('/admin/user/edit', 'admin/user/edit/patch.php')->only('admin');
    $router->delete('/admin/user/destroy', 'admin/user/destroy.php')->only('admin');

    // Add User
    $router->get('/admin/user/add', 'admin/user/add/create.php')->only('admin');
    $router->post('/admin/user/add', 'admin/user/add/store.php')->only('admin');

    // Admin profile
    $router->get("/profile", 'profile/create.php')->only('admin');
    $router->put("/profile", 'profile/update.php')->only('admin');
    $router->patch("/profile", 'profile/patch.php')->only('admin');
}

// User
if (isset($session->user)) {
    // Dashboard
    $router->get("/{$session->user['username']}", 'user/index.php')->only('auth');
    $router->get("/{$session->user['username']}/charts", 'user/charts.php')->only('auth');

    // Add
    $router->get("/{$session->user['username']}/add", 'user/add.php')->only('auth');

    // Daily Exercise
    $router->get("/{$session->user['username']}/add/daily-exercise", 'user/daily-exercise/create.php')->only('auth');
    $router->get("/{$session->user['username']}/add/daily-exercise/data", 'user/daily-exercise/data.php')->only('auth');
    $router->post("/{$session->user['username']}/add/daily-exercise", 'user/daily-exercise/store.php')->only('auth');

    // Stay Hydrated
    $router->get("/{$session->user['username']}/add/stay-hydrated", 'user/stay-hydrated/create.php')->only('auth');
    $router->get("/{$session->user['username']}/add/stay-hydrated/data", 'user/stay-hydrated/data.php')->only('auth');
    $router->post("/{$session->user['username']}/add/stay-hydrated", 'user/stay-hydrated/store.php')->only('auth');

    // Balanced Nutrition
    $router->get("/{$session->user['username']}/add/balanced-nutrition", 'user/balanced-nutrition/create.php')->only('auth');
    $router->get("/{$session->user['username']}/add/balanced-nutrition/data", 'user/balanced-nutrition/data.php')->only('auth');
    $router->post("/{$session->user['username']}/add/balanced-nutrition", 'user/balanced-nutrition/store.php')->only('auth');

    // Quality Sleep
    $router->get("/{$session->user['username']}/add/quality-sleep", 'user/quality-sleep/create.php')->only('auth');
    $router->get("/{$session->user['username']}/add/quality-sleep/data", 'user/quality-sleep/data.php')->only('auth');
    $router->post("/{$session->user['username']}/add/quality-sleep", 'user/quality-sleep/store.php')->only('auth');

    // Reminder
    $router->post("/{$session->user['username']}/add/daily-exercise/notification", 'user/notification/store.php')->only('auth');
    $router->post("/{$session->user['username']}/add/stay-hydrated/notification", 'user/notification/store.php')->only('auth');
    $router->post("/{$session->user['username']}/add/balanced-nutrition/notification", 'user/notification/store.php')->only('auth');
    $router->post("/{$session->user['username']}/add/quality-sleep/notification", 'user/notification/store.php')->only('auth');

    // Customize Reminder
    $router->get("/{$session->user['username']}/notification", 'user/notification/data.php')->only('auth');

    // Profile
    $router->get("/profile", 'profile/create.php')->only('auth');
    $router->put("/profile", 'profile/update.php')->only('auth');
    $router->patch("/profile", 'profile/patch.php')->only('auth');

    $router->get("/{$session->user['username']}/reminder", 'user/reminder/create.php')->only('auth');
    $router->patch("/{$session->user['username']}/reminder", 'user/reminder/patch.php')->only('auth');
}
