<?php

namespace App\Http\Middleware;

use App\Session;

class Email
{
    public function handle()
    {
        $session = Session::getInstance();
        if (!$session->reset_token ?? false) {
            redirect("/");
        }
    }
}
