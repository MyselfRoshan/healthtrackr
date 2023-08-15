<?php

namespace App\Http\Middleware;

use App\Session;

class Guest
{
    public function handle()
    {
        $session = Session::getInstance();
        if ($session->user ?? false) {
            redirect("/{$session->user['username']}");
        }
    }
}
