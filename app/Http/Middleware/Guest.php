<?php

namespace App\Http\Middleware;

use App\Session;

class Guest
{
    public function handle()
    {
        $session = Session::getInstance();
        if ($session->user ?? false && isset($_COOKIE['remember_me'])) {
            $session->user = json_decode($_COOKIE['remember_me'], true);
            redirect("/{$session->user['username']}");
        }
    }
}
