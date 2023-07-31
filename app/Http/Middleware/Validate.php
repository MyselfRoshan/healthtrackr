<?php

namespace App\Http\Middleware;

class Validate
{
    public static function isEmpty($value)
    {
        return empty($value);
    }
    public static function username($value)
    {
        // Alphanumeric username
        return preg_match('/^[a-zA-Z]+[_0-9]*/', $value);
    }
    public static function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
    public static function length($value, $min = 8, $max = 255)
    {
        return strlen($value) >= $min && strlen($value) <= $max;
    }
    public static function password($value)
    {
        return preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,255}$/m', $value);
    }
}
