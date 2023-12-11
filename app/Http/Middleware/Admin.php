<?php

namespace App\Http\Middleware;

use App\Session;

class Admin
{
    public function handle()
    {
        $session = Session::getInstance();
        if (!$session->is_admin ?? false && !isset($_COOKIE['remember_me'])) {
            redirect('/');
        }
    }
}
