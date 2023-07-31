<?php

use App\Http\Middleware\Validate;
use Database\Database;

extract($_POST);
// Username validation
if (Validate::isEmpty($username))
    $alerts['username'] = "*Username is required";
else if (!Validate::username($username))
    $alerts['username'] = "Should be alpha numeric eg:john123";
// Email validation
if (Validate::isEmpty($email))
    $alerts['email'] = "*Email is required";
else if (!Validate::email($email))
    $alerts['email'] = "Invalid email!!!";
// Password validation
if (Validate::isEmpty($password))
    $alerts['password'] = "*Password is required";
else if (!Validate::length($password))
    $alerts['password'] = "At least 8 character long";
elseif (!Validate::password($password))
    $alerts['password'] = "At least one uppercase,one lowercase and one special character";
// If $alerts is found redirect to same page else redirect to login page
if (!empty($alerts)) {
    require_view('signup.view.php', [
        'alerts' => $alerts,
        'scripts' => [
            '/resources/js/ajaxRedirect.js',
        ]
    ]);
} else {
    $query = "INSERT users(username,email,password) VALUES(:username,:email,:password)";
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    $params = [
        'username' => [$username, PDO::PARAM_STR],
        'email' => [$email, PDO::PARAM_STR],
        'password' => [$hashedPassword, PDO::PARAM_STR]
    ];
    Database::insert($query, $params);
    header('location: /login');
    die();
}
