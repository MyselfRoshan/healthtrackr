<?php

use App\Session;
use Database\Database;

$session = Session::getInstance();
$query = "SELECT first_name,last_name,username,email,last_login,created_on FROM public.user WHERE username = :params";
$params = [
    "params" => [$session->user['username'], PDO::PARAM_STR]
];
$user = Database::select($query, $params)->fetch();

d($user);
// $session->regenerateID();
// $session->user = [
//     'username' => $user['username'],
//     'email' => $user['email']
// ];
require_view('user/profile.view.php', [
    'scripts' => [
        "type='module' src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js'",
        "nomodule src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js'",
        "src='/resources/js/input.js'",
        "src='/resources/js/profile.js'",
        "src='/resources/js/dashboardSidebar.js'"
    ],
    'user' => $user
]);
