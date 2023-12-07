<?php

use Database\Database;

$query = "SELECT
    users.user_id,
    first_name,
    last_name,
    username,
    password,
    email,
    created_on,
    last_login,
    timezone,
    is_admin,
    age,
    height,
    weight,
    profile_pic
    FROM users LEFT JOIN profile
    ON users.user_id = profile.user_id";
$users = Database::select($query)->fetchAll();
// d($users);
require_view('admin/user/index.view.php', [
    'scripts' => [
        "type='module' src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js'",
        "nomodule src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js'",
        "src='/resources/js/dashboardSidebar.js'",
        "type='module' src='/resources/js/admin-user.js'",
    ], 'users' => $users
]);
