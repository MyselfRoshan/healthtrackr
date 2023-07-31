<?php

namespace App\Http\Middleware;

class Guest
{
    public function handle()
    {
        if ($_SESSION['user'] ?? false) {
            header('location: /');
            die();
        }
    }
}
