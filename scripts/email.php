<?php

declare(strict_types=1);

use App\Enums\EmailStatus;
use App\Helper\Mail;
use App\Models\Email;

require_once __DIR__ . '/../vendor/autoload.php';
const BASE_PATH = __DIR__ . "/../";
require BASE_PATH . "config/bootstrap.php";

// $emailModel = new Email();
// $scheduledEmails = $emailModel->getEmailsByStatus(EmailStatus::Queue);
// foreach ($scheduledEmails as $email) {
//     $mail = new Mail(
//         $email['recipent'],
//         $email['subject'],
//         $email['html_body'],
//         $email['text_body']
//     );
//     $result = $mail->send();

//     if ($result) {
//         // Mark the email as sent in the database
//         $emailModel->markEmailSent($email['id']);
//     } else {
//         $emailModel->updateEmailStatus($email['id'], EmailStatus::Failed);
//         sleep(5);
//         $emailModel->updateEmailStatus($email['id'], EmailStatus::Queue);
//     }
// }

$emailModel = new Email();
$scheduledEmails = $emailModel->getEmailsByStatus(EmailStatus::Queue);

$originalTimeZone = date_default_timezone_get();
date_default_timezone_set('Asia/Kathmandu');

foreach ($scheduledEmails as $email) {
    $now = new DateTime();
    $scheduledTime = new DateTime($email['scheduled_at']);
    $createdAtTime = new DateTime($email['created_at']);

    if (isTimeBetween($scheduledTime, $createdAtTime, $now) && sendEmail($email)) {
        $emailModel->markEmailSent($email['id']);
    } else {
        retrySendEmail($emailModel, $email['id']);
    }
}

date_default_timezone_set($originalTimeZone);

function isTimeBetween(DateTime $time, DateTime $start, DateTime $end): bool
{
    $timeOnly = $time->format('H:i:s');
    $startOnly = $start->format('H:i:s');
    $endOnly = $end->format('H:i:s');

    return $timeOnly >= $startOnly && $timeOnly <= $endOnly;
}

function sendEmail(array $email): bool
{
    $mail = new Mail(
        $email['recipent'],
        $email['subject'],
        $email['html_body']
    );

    return $mail->send();
}

function retrySendEmail(Email $emailModel, int $emailId): void
{
    $emailModel->updateEmailStatus($emailId, EmailStatus::Failed);
    $emailModel->updateEmailStatus($emailId, EmailStatus::Queue);
}


echo "corn is working\n";
