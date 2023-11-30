<?php
$EMAIL = [
    'password_reset' => [
        'subject' => "Click Here to Reset Your Password",
        'body' => <<<HTMLBody
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
    HTMLBody,
        'text_body' => <<<TEXTBODY
    Hello there,

    We received a request to reset your password. If you didn't make this request, you can ignore this email.

    If you did request a password reset, please copy and paste the following URL into your browser:

    {$_SERVER['HTTP_ORIGIN']}/password-reset/{$session->reset_token}

    This link will expire in 1 hour for security reasons.

    If you have any questions or need further assistance, please don't hesitate to contact us.

    Best regards,
    Health Trackr Team
    TEXTBODY
    ]
];
