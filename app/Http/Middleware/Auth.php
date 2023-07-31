<?php

namespace App\Http\Middleware;

class Auth
{
    public function handle()
    {
        if (!$_SESSION['user'] ?? false) {
            header('location: /');
            die();
        }
    }
}
