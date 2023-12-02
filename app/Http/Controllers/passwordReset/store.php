<?php

use App\Helper\Mail;
use App\Helper\PasswordResetToken;
use App\Http\Forms\PasswordResetForm;
use App\Session;
use Database\Database;

extract($_POST);

$form = new PasswordResetForm();
if (!$form->validate($_POST)) {

    require_view('passwordReset/index.view.php', [
        'scripts' => [
            'type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"',
            'nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"',
            'src="/resources/js/input.js"',
        ],
        'alerts' => $form->getAlerts()
    ]);
} else {
    // TO DO get reset_token_expires_at from database and insert into the app not from PAsswordReset
    $session = Session::getInstance();
    // If reset token expired regenerate new one and save to the database
    if ((!isset($session->reset_token) && !isset($session->reset_token_expires_at)) || strtotime($session->reset_token_expires_at) <= time()) {
        $token = new PasswordResetToken(32);
        $session->reset_token = $token->getToken();
        $session->reset_token_expires_at = $token->getExpiry();
        $query = "UPDATE users
        SET reset_token_hash = :token_hash,
            reset_token_expires_at = CURRENT_TIMESTAMP + interval '1 hour'
        WHERE email = :email";

        $params = [
            'token_hash' => [$token->getTokenHash(), PDO::PARAM_STR],
            'email' => [$email, PDO::PARAM_STR],
        ];
        Database::insert($query, $params);
    }

    require base_path("config/email_data2.php");
    $mail = new Mail(
        $email,
        $EMAIL['password_reset']['subject'],
        $EMAIL['password_reset']['body'],
        $EMAIL['password_reset']['text_body']
    );
    $mail->send();
    require_view('passwordReset/email-sent-sucessfully.view.php', [
        'scripts' => [
            'type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"',
            'nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"',
        ],
    ]);
}
