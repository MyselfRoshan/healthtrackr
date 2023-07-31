<?php

use App\Http\Middleware\Validate;
use Database\Database;

extract($_POST);
// Email validation
if (Validate::isEmpty($lemail))
    $alerts['lemail'] = "*Email is required";
else if (!Validate::email($lemail))
    $alerts['lemail'] = "Invalid email!!!";
// Password validation
if (Validate::isEmpty($lpassword))
    $alerts['lpassword'] = "*Password is required";
else if (!Validate::length($lpassword))
    $alerts['lpassword'] = "At least 8 character long";
elseif (!Validate::password($lpassword))
    $alerts['lpassword'] = "At least one uppercase,one lowercase and one special character";
// If $alerts is found redirect to same page else redirect to signup page
if (!empty($alerts)) {
    require_view('login.view.php', [
        'alerts' => $alerts,
        'scripts' => [
            '/resources/js/ajaxRedirect.js',
        ]
    ]);
} else {
    $query = "SELECT username,email,password FROM users WHERE email=:email";
    $params = [
        'email' => [$lemail, PDO::PARAM_STR]
    ];
    $user = Database::select($query, $params)->fetch();

    if (!password_verify($lpassword, $user['password'])) {

        require_view('login.view.php', [
            'alerts' => [
                'lpassword' => "Incorrect password",
            ],
            'scripts' => [
                '/resources/js/ajaxRedirect.js',
            ]
        ]);
    } else {
        login($user);
        header("location: /board");
        die();
    }

    if (!$user) {
        require_view('login.view.php', [
            'alerts' => [
                'lemail' => 'Email not found',
            ],
            'scripts' => [
                '/resources/js/ajaxRedirect.js',
            ]
        ]);
    }
}
