<?php

namespace App\Http\Middleware;

use App\Session;

class Auth
{
    public function handle()
    {
        $session = Session::getInstance();
        if (!$session->user ?? false && !isset($_COOKIE['remember_me'])) {
            redirect('/');
        }
    }
}
