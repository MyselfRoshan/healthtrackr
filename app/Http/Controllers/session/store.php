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
    $query = "SELECT username,email FROM public.user WHERE {$column} = :params";
    $params = [
        "params" => [$usrname_email, PDO::PARAM_STR]
    ];
    $user = Database::select($query, $params)->fetch();


    $session = Session::getInstance();
    $session->regenerateID();
    $session->user = [
        'username' => $user['username'],
        'email' => $user['email']
    ];
    // $a = Token::generateAccessToken($session->user);
    // d($a);
    // d(Token::verifyAccessToken($a));
    if (isset($remember_me)) {
        $expiry_date = time() + (30 * 24 * 60 * 60); // 30 days
        setcookie("remember_me", json_encode($user), $expiry_date);
    }

    redirect("/{$session->user['username']}");
}