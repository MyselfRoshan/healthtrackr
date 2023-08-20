<?php

use App\Helper\Mailer;
use App\Helper\PasswordResetToken;
use App\Http\Forms\PasswordResetForm;
use App\Session;
use Database\Database;
use PHPMailer\PHPMailer\Exception;

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
    $session = Session::getInstance();
    // If reset token expired regenerate new one and save to the database
    if ((!isset($session->reset_token) && !isset($session->reset_token_expires_at)) || strtotime($session->reset_token_expires_at) <= time()) {
        // $token = new PasswordResetToken(32, 15);
        $token = new PasswordResetToken();
        $session->reset_token = $token->getToken();
        $session->reset_token_expires_at = $token->getExpiry();
        $query = "UPDATE public.user
        SET reset_token_hash = :token_hash,
            reset_token_expires_at = :token_expires_at
        WHERE email = :email";

        $params = [
            'token_hash' => [$token->getTokenHash(), PDO::PARAM_STR],
            'token_expires_at' => [$token->getExpiry(), PDO::PARAM_STR],
            'email' => [$email, PDO::PARAM_STR],
        ];
        Database::insert($query, $params);
    }

    $mailer = Mailer::getInstance();
    // Receipts
    $mailer->setFrom(MAILER_NOREPLY_SENDER_EMAIL_ADDRESS, MAILER_NOREPLY_SENDER_NAME);
    $mailer->addAddress($email);
    $HTMLBody = <<<HTMLBody
    
    <p>Hello there,</p>
    <p>We received a request to reset your password. If you didn't make this request, you can ignore this email.</p>
    <p>If you did request a password reset, please click the link below to reset your password:</p>
    
    <p>
        <a href="http://localhost/password-reset/{$session->reset_token}" target="_blank" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none;">Reset Password</a>
    </p>
    
    <p>If the above link doesn't work, you can copy and paste the following URL into your browser:</p>
    
    <p>http://localhost/password-reset/{$session->reset_token}</p>
    
    <p>This link will expire in 1 hour for security reasons.</p>
    
    <p>If you have any questions or need further assistance, please don't hesitate to contact us.</p>
    
    <p>Best regards,<br>Health Trackr Team</p>
    
    HTMLBody;

    $altBody = <<<altBody

    Hello there,

    We received a request to reset your password. If you didn't make this request, you can ignore this email.
    
    If you did request a password reset, please copy and paste the link below into your browser's address bar to reset your password:
    
    http://localhost/password-reset/{$session->reset_token}
    
    This link will expire in 1 hour for security reasons.
    
    If you have any questions or need further assistance, please don't hesitate to contact us.
    
    Best regards,
    Health Trackr Team
    
    altBody;
    try {
        $mailer->Body = $HTMLBody;
        $mailer->AltBody = $altBody;
        // Send the email
        $mailer->send();
        require_view('passwordReset/email-sent-sucessfully.view.php', [
            'scripts' => [
                'type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"',
                'nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"',
            ],
        ]);
    } catch (Exception $e) {
        echo 'Email could not be sent. Error: ', $mailer->ErrorInfo;
    }
}
