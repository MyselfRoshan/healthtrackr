<?php

declare(strict_types=1);

use App\Helper\Mail;
use App\Models\Email;

// require_once __DIR__ . '/../vendor/autoload.php';

// $HTMLBody = <<<HTMLBody
//     <p>Hello there,</p>
//     <p>We received a request to reset your password. If you didn't make this request, you can ignore this email.</p>
//     <p>If you did request a password reset, please click the link below to reset your password:</p>
//     HTMLBody;
// $subject = "Click Here to Reset Your Password";
// $mail = new Mail($email, $subject, $HTMLBody);
// $mail->send();

// $scheduledEmails = $emailModel->getEmailsByStatus(\App\Enums\EmailStatus::Queue);

$emailModel=new Email();
foreach ($scheduledEmails as $email) {
    $mail = new Mail(
        $email['meta']['to'],
        $email['subject'],
        $email['html_body']
    );

    $result = $mail->send();

    if ($result) {
        // Mark the email as sent in the database
        $emailModel->markEmailSent($email['id']);
    }
}
