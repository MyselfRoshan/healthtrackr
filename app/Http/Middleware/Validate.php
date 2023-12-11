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
    public static function isIntegerInRange($value, $min, $max)
    {
        return intval($value) >= $min && intval($value) <= $max;
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
        $query = "SELECT {$column} FROM {$table} WHERE {$column} = :{$column}";
        $params = [
            "{$column}" => [$valueToBeChecked, PDO::PARAM_STR]
        ];
        $result = Database::select($query, $params)->fetch();


        return !empty($result);
    }

    /**
     * Checks if a value is already taken in a specified column of a database table, excluding a specific value.
     *
     * @param string $table The name of the database table.
     * @param string $column The column to check for duplicates.
     * @param mixed $valueToBeChecked The value to check for duplicates.
     * @param string $excludeColumn The column to exclude for checking duplicates.
     * @param mixed $excludeValue The value to exclude from the duplicate check.
     *
     * @return bool Returns true if the value is already taken, false otherwise.
     */
    public static function isValueTaken($table, $column, $valueToBeChecked, $excludeColumn, $excludeValue): bool
    {
        $query = "SELECT COUNT(*) FROM {$table} WHERE {$column} = :value AND {$excludeColumn} != :excludeValue";
        $params = [
            ':value' => [$valueToBeChecked, PDO::PARAM_STR],
            ':excludeValue' => [$excludeValue, PDO::PARAM_INT],
        ];

        $result = Database::select($query, $params)->fetchColumn();

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
        $query = "SELECT {$column} FROM users WHERE {$column} = :params";
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
        $query = "SELECT {$column},password FROM users WHERE {$column} = :params";
        $params = [
            "params" => [$usrname_email, PDO::PARAM_STR]
        ];
        $user = Database::select($query, $params)->fetch();
        if (!empty($user))
            return password_verify($plainPassword, $user['password']);
    }
    /**
     * Check if the provided password matches the password stored for the user with the given ID.
     *
     * @param int    $userId         The ID of the user.
     * @param string $plainPassword  The plain text password to be checked.
     *
     * @return bool True if the password matches, false otherwise.
     */
    public static function passwordMatchesById($user_id, $plainPassword)
    {
        if (!trim($user_id)) return false;
        $query = "SELECT password FROM users WHERE user_id = :user_id";
        $params = [
            'user_id' => [$user_id, PDO::PARAM_INT]
        ];
        $user = Database::select($query, $params)->fetch();
        if (!empty($user)) {
            return password_verify($plainPassword, $user['password']);
        }
    }

    /**
     * Check if a user is an admin based on their username or email.
     *
     * @param string $valueToBeChecked The username or email of the user.
     *
     * @return bool True if the user is an admin, false otherwise.
     */
    public static function isAdmin($valueToBeChecked)
    {
        $column = static::isEmail($valueToBeChecked) ? 'email' : 'username';
        $query = "SELECT is_admin FROM users WHERE {$column} = :params";
        $params = [
            "params" => [$valueToBeChecked, PDO::PARAM_STR]
        ];
        $result = Database::select($query, $params)->fetch();

        return !empty($result) && $result['is_admin'] == 1;
    }
}
