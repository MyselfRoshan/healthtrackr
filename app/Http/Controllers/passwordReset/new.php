<?php

use App\Http\Forms\PasswordResetForm;
use App\Session;
use Database\Database;


$session = Session::getInstance();
$reset_token_hash = hash('sha256', $session->reset_token);
$query = "SELECT * from public.user
WHERE reset_token_hash = :token_hash";
$params = [
    'token_hash' => [$reset_token_hash, PDO::PARAM_STR]
];
$user = Database::select($query, $params)->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    extract($_POST);

    $form = new PasswordResetForm();
    if (!$form->validate($_POST)) {
        require_view('passwordReset/new.view.php', [
            'username' => $user['username'],
            'scripts' => [
                'type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"',
                'nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"',
                'src="/resources/js/input.js"',
            ],
            'alerts' => $form->getAlerts()
        ]);
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        // $query = "UPDATE public.user
        // SET password = :password,
        //     reset_token_hash = :token_hash,
        //     reset_token_expires_at = :token_expiry
        // WHERE email = :email";
        // $params = [
        //     'email' => [$user['email'], PDO::PARAM_STR],
        //     'password' => [$hashedPassword, PDO::PARAM_STR],
        //     'token_hash' => [null, PDO::PARAM_STR],
        //     'token_expiry' => [null, PDO::PARAM_STR]
        // ];
        $query = "UPDATE public.user
        SET password = :password
        WHERE email = :email";
        $params = [
            'email' => [$user['email'], PDO::PARAM_STR],
            'password' => [$hashedPassword, PDO::PARAM_STR],
        ];
        Database::update($query, $params);
        $redirectAfter = 5;
        redirect("/signin", $redirectAfter);
        require_view('passwordReset/sucessful-redirect.view.php', [
            'redirectAfter' => $redirectAfter
        ]);
    }
} else {
    if (strtotime($user['reset_token_expires_at']) <= time()) {
        redirect('/password-reset');
    } else {
        require_view('passwordReset/new.view.php', [
            'username' => $user['username'],
            'scripts' => [
                'type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"',
                'nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"',
                'src="/resources/js/input.js"',
            ]
        ]);
    }
}