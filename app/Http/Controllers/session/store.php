<?php

use App\Helper\Token;
use App\Http\Forms\SigninForm;
use App\Http\Middleware\Validate;
use App\Session;
use Database\Database;

extract($_POST);

$form = new SigninForm();
if (!$form->validate($_POST)) {

    require_view('signin.view.php', [
        'scripts' => [
            "type='module' src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js'",
            "nomodule src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js'",
            "src='/resources/js/input.js'",
        ],
        'alerts' => $form->getAlerts()
    ]);
} else {
    $column = Validate::isEmail($usrname_email) ? 'email' : 'username';
    $query = "SELECT user_id,first_name,username,email,profile_pic FROM public.user WHERE {$column} = :params";
    $params = [
        "params" => [$usrname_email, PDO::PARAM_STR]
    ];
    $user = Database::select($query, $params)->fetch();
    // Update user last login
    $query = "UPDATE public.user
    SET last_login = CURRENT_TIMESTAMP
    WHERE email = :email";
    $params = [
        "email" => [$user['email'], PDO::PARAM_STR]
    ];
    Database::update($query, $params);

    $session = Session::getInstance();
    $session->regenerateID();
    $session->user = [
        'id' => $user['user_id'],
        'username' => $user['username'],
        'email' => $user['email'],
    ];
    $session->profile_pic = $user['profile_pic'];
    $expiry_date = time() + (30 * 24 * 60 * 60); // 30 days
    if (isset($remember_me)) {
        setcookie("remember_me", json_encode($user), $expiry_date);
    }
    setcookie("first_name", $user['first_name'], $expiry_date);

    redirect("/{$session->user['username']}");
}
