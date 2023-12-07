<?php

namespace App\Http\Middleware;

use App\Session;

class Guest
{
    public function handle()
    {
        $session = Session::getInstance();
        if ($session->is_admin ?? false) {
            redirect("/admin");
        } else {
            if (isset($_COOKIE['remember_me'])) {
                $session->user = json_decode($_COOKIE['remember_me'], true);
                redirect("/{$session->user['username']}");
            } elseif ($session->user ?? false) {
                redirect("/{$session->user['username']}");
            }
        }
    }
}
