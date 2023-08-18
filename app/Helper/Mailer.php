<?php

namespace App\Helper;

use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
    private $instance;
    public function __construct()
    {
        // Server settings
        $this->instance = new PHPMailer();
        $this->instance->isSMTP();
        $this->instance->isHTML();
        $this->instance->Host       = MAILER_HOST;
        $this->instance->Port       = MAILER_PORT;
        // $this->instance->Username   = MAILER_USERNAME;
        // $this->instance->Password   = MAILER_PASSWORD;
        $this->instance->SMTPAuth   = MAILER_SMTP_AUTH;
        // $this->instance->SMTPDebug  = MAILER_SMTP_DEBUG;
    }

    public static function getInstance()
    {
        return (new self)->instance;
    }
}
