<?php

declare(strict_types=1);

use App\Enums\EmailStatus;
use App\Helper\Mail;
use App\Models\Email;

require_once __DIR__ . '/../vendor/autoload.php';
const BASE_PATH = __DIR__ . "/../";
require BASE_PATH . "config/bootstrap.php";

$emailModel = new Email();
$scheduledEmails = $emailModel->getEmailsByStatus(EmailStatus::Queue);
foreach ($scheduledEmails as $email) {
    $mail = new Mail(
        $email['recipent'],
        $email['subject'],
        $email['html_body'],
        $email['text_body']
    );
    $result = $mail->send();

    if ($result) {
        // Mark the email as sent in the database
        $emailModel->markEmailSent($email['id']);
    } else {
        $emailModel->updateEmailStatus($email['id'], EmailStatus::Failed);
        sleep(5);
        $emailModel->updateEmailStatus($email['id'], EmailStatus::Queue);
    }
}
echo "corn is working";
