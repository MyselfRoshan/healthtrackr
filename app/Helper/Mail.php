<?php

namespace App\Helper;

use App\Enums\EmailStatus;
use App\Models\Email;
use DateTime;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail
{
    private $mailer;
    private $recipient;
    private $subject;
    private $message;

    public function __construct(string $recipient, string $subject, string $message)
    {
        $this->recipient = $recipient;
        $this->subject = $subject;
        $this->message = $message;

        // Create a new PHPMailer instance
        $this->mailer = new PHPMailer(true);
        $this->mailer->isSMTP();
        $this->mailer->isHTML();
        $this->mailer->Host       = MAILER_HOST;
        $this->mailer->SMTPAuth   = MAILER_SMTP_AUTH;
        $this->mailer->Port       = MAILER_PORT;
        // $this->mailer->SMTPSecure = 'tls';
        // $this->mailer->Username   = MAILER_USERNAME;
        // $this->mailer->Password   = MAILER_PASSWORD;
        // $this->mailer->SMTPDebug  = MAILER_SMTP_DEBUG;
    }

    public function send()
    {
        try {
            // Set the recipient and sender
            $this->mailer->setFrom(MAILER_NOREPLY_SENDER_EMAIL_ADDRESS, MAILER_NOREPLY_SENDER_NAME);
            $this->mailer->addAddress($this->recipient);

            // Set email subject and message
            $this->mailer->Subject = $this->subject;
            $this->mailer->Body = $this->message;
            $this->mailer->AltBody = strip_tags($this->mailer->Body);

            // Send the email
            $this->mailer->send();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function scheduleSend(string $dateTime, int $emailId)
    {
        // Schedule the email to be sent at a specific date and time
        $now = new DateTime();
        $scheduledTime = new DateTime($dateTime);

        if ($scheduledTime > $now) {
            $delay = $scheduledTime->getTimestamp() - $now->getTimestamp();
            // sleep($delay);

            // Update the email status to 'Queue' in the database
            $emailModel = new Email();
            $emailModel->updateEmailStatus($emailId, EmailStatus::Queue);

            return true;
        }

        return false;
    }
}