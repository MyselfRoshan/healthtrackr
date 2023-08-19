<?php

namespace App\Http\Middleware;

use App\Session;

class Email
{
    public function handle()
    {
        $session = Session::getInstance();
        if (($session->reset_token && $session->reset_token_expires_at <= time()) ?? false) {
            redirect("/");
        }
    }
}
