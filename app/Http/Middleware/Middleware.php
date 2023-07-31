<?php


namespace App\Http\Middleware;

use Exception;

class Middleware
{
    public const MAP = [
        'guest' => Guest::class,
        'auth' => Auth::class
    ];

    public static function resolve($value)
    {
        if (!$value) return;

        $middleware = Middleware::MAP[$value] ?? false;
        if (!$middleware) {
            throw new Exception("No matching middleware found for value '{$value}'");
        }
        (new $middleware)->handle();
    }
}
