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
    private $html_body;
    private $text_body;

    public function __construct(string $recipient, string $subject, string $html_body, ?string $text_body = null)
    {
        $this->recipient = $recipient;
        $this->subject = $subject;
        $this->html_body = $html_body;
        $this->text_body = $text_body;

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

            // Set email subject and html_body
            $this->mailer->Subject = $this->subject;
            $this->mailer->Body = $this->html_body;
            // remove content from style tag and only show html body
            $this->mailer->AltBody = $this->text_body ?? strip_tags(preg_replace('/<style[^>]*>.*?<\/style>/si', '', $this->html_body));
            // Send the email
            $this->mailer->send();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
