<?php


namespace App\Helper;

use DateTime;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Notification
{
    private $mailer;
    private $recipient;
    private $subject;
    private $message;

    public function __construct($recipient, $subject, $message)
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

            // Send the email
            $this->mailer->send();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function scheduleSend($dateTime)
    {
        // Schedule the email to be sent at a specific date and time
        $now = new DateTime();
        $scheduledTime = new DateTime($dateTime);

        if ($scheduledTime > $now) {
            $delay = $scheduledTime->getTimestamp() - $now->getTimestamp();
            sleep($delay);

            return $this->send();
        }

        return false;
    }
}

// Usage
$recipient = 'recipient@example.com';
$subject = 'Scheduled Notification';
$message = 'This is a scheduled notification.';
$scheduledTime = '2023-11-01 12:00:00'; // Replace with your desired date and time

$notification = new Notification($recipient, $subject, $message);
if ($notification->scheduleSend($scheduledTime)) {
    echo 'Notification scheduled and sent successfully.';
} else {
    echo 'Failed to schedule or send the notification.';
}
