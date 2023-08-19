<?php

use App\Session;
use Database\Database;

$query = "SELECT * from public.user
WHERE reset_token_hash = :token_hash";
$params = [
    'token_hash' => [hash('sha256', Session::getInstance()->reset_token), PDO::PARAM_STR]
];
$user = Database::select($query, $params)->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    /** 
     * Implement validation for new password and make front end look good
     */
    extract($_POST);

    $query = "UPDATE public.user
    SET password = :password
    WHERE email = :email";
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    $params = [
        'email' => [$user['email'], PDO::PARAM_STR],
        'password' => [$hashedPassword, PDO::PARAM_STR],
    ];
    Database::update($query, $params);
    // echo "passsword reset sucessfully";
    redirect('/signin');
}
if (strtotime($user['reset_token_expires_at']) <= time()) {
    $token_expired = true;
    redirect('/password-reset');
} else {
    require_view('passwordReset/new.view.php', [
        'username' => $user['username'],
        'scripts' => [
            'type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"',
            'nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"',
            'src="resources/js/input.js"',
        ]
    ]);
}
