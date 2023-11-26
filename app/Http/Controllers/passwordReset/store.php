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
        // $token = new PasswordResetToken(32, 15);
        $token = new PasswordResetToken(32);
        $session->reset_token = $token->getToken();
        $session->reset_token_expires_at = $token->getExpiry();
        $query = "UPDATE public.user
        SET reset_token_hash = :token_hash,
            reset_token_expires_at = CURRENT_TIMESTAMP + interval '1 minute'
            -- reset_token_expires_at = CURRENT_TIMESTAMP + interval '1 hour'
        WHERE email = :email";

        $params = [
            'token_hash' => [$token->getTokenHash(), PDO::PARAM_STR],
            'email' => [$email, PDO::PARAM_STR],
        ];
        Database::insert($query, $params);
    }

    $HTMLBody = <<<HTMLBody
    <p>Hello there,</p>
    <p>We received a request to reset your password. If you didn't make this request, you can ignore this email.</p>
    <p>If you did request a password reset, please click the link below to reset your password:</p>

    <p>
        <a href="{$_SERVER['HTTP_ORIGIN']}/password-reset/{$session->reset_token}" target="_blank" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none;">Reset Password</a>
    </p>

    <p>If the above link doesn't work, you can copy and paste the following URL into your browser:</p>

    <p> {$_SERVER['HTTP_ORIGIN']}/password-reset/{$session->reset_token}</p>

    <p>This link will expire in 1 hour for security reasons.</p>

    <p>If you have any questions or need further assistance, please don't hesitate to contact us.</p>

    <p>Best regards,<br>Health Trackr Team</p>

    HTMLBody;
    $subject = "Click Here to Reset Your Password";
    $mail->send();
    $mail = new Mail($email, $subject, $HTMLBody);
    // Schedule the email to be sent one minute from now using the obtained email ID
    $scheduledTime = (new DateTime())->add(new DateInterval('PT1M'))->format('Y-m-d H:i:s');
    $mail->scheduleSend($scheduledTime, $emailId);
    // Send the email
    require_view('passwordReset/email-sent-sucessfully.view.php', [
        'scripts' => [
            'type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"',
            'nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"',
        ],
    ]);
}
