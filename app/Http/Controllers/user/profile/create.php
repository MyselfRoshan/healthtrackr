<?php

use App\Session;
use Database\Database;

$session = Session::getInstance();
$query = "SELECT
            first_name,
            last_name,
            username,
            email,
            password,
            last_login,
            created_on,
            timezone,
            profile_pic,
            (SELECT age FROM public.profile WHERE user_id = :id) AS age,
            (SELECT weight FROM public.profile WHERE user_id = :id) AS weight,
            (SELECT height FROM public.profile WHERE user_id = :id) AS height
          FROM
            public.user
          WHERE
            user_id = :id";
$params = [
    "id" => [$session->user['id'], PDO::PARAM_STR]
];
$user = Database::select($query, $params)->fetch();

// d($user);
$user['last_login'] = timeago($user['last_login']);
$user['created_on'] = getUserDate($user['created_on'], $user['timezone'])->format('jS, F Y');
$user['profile_pic'] = $user['profile_pic'] ?? "/resources/images/default-profile.png";
$session->profile_pic = $user['profile_pic'];
// d(new DateTime($user['created_on'], new DateTimeZone($user['timezone'])));
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
    'user' => $user,
    'alerts' => []
]);
