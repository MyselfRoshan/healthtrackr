<?php

namespace App\Http\Middleware;

use Database\Database;
use PDO;

class Validate
{
    public static function isEmpty($value)
    {

        return empty(trim($value));
    }
    public static function alphaNumeric($value)
    {
        // Alphanumeric username
        return preg_match('/^[a-zA-Z]+[_0-9]*/', $value);
    }
    public static function isEmail($value)
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

    /**
     * Find duplicate email or username from the user database
     * 
     * @param string $table name
     * @param string $column like email or username
     * @param string $valueToBeChecked of the key
     * 
     * @return bool false if no duplicate data found in database.
     */
    public static function duplicate($table, $column, $valueToBeChecked): bool
    {
        $query = "SELECT {$column} FROM public.{$table} WHERE {$column} = :{$column}";
        $params = [
            "{$column}" => [$valueToBeChecked, PDO::PARAM_STR]
        ];
        $result = Database::select($query, $params)->fetch();


        return !empty($result);
    }


    /**
     * Implement to check wether email or username exits in database
     * 
     * @param string $table name
     * @param string $column like email or username
     * @param string $valueToBeChecked of the key
     * 
     * @return bool true if user exists in database.
     */
    public static function userExits($valueToBeChecked)
    {
        $column = static::isEmail($valueToBeChecked) ? 'email' : 'username';
        $query = "SELECT {$column} FROM public.user WHERE {$column} = :params";
        $params = [
            "params" => [$valueToBeChecked, PDO::PARAM_STR]
        ];
        $result = Database::select($query, $params)->fetch();


        return !empty($result);
    }

    /**
     * @param string $usrname_email email or username
     * @param string $plainPassword user entered password
     * 
     * @return true if password matces with the given user in database
     */
    public static function passwordMatches($usrname_email, $plainPassword)
    {
        if (!trim($usrname_email)) return false;
        $column = static::isEmail($usrname_email) ? 'email' : 'username';
        $query = "SELECT {$column},password FROM public.user WHERE {$column} = :params";
        $params = [
            "params" => [$usrname_email, PDO::PARAM_STR]
        ];
        $user = Database::select($query, $params)->fetch();
        if (!empty($user))
            return password_verify($plainPassword, $user['password']);
    }
}
