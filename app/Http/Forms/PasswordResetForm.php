<?php

namespace App\Http\Forms;

use App\Http\Middleware\Validate;

class PasswordResetForm
{
    private array $alerts = [];

    /**
     * @param array $postRequestArray provide $_POST array as an argument
     *
     * @return bool true if validation is sucessful else false
     */
    public function validate(array $postRequestArray): bool
    {
        extract($postRequestArray);

        // Username or email validation
        if (isset($email)) {
            if (Validate::isEmpty($email))
                $this->alerts['email'] = "*Email is required";
            elseif (!Validate::userExits($email))
                $this->alerts['email'] = "User with this email doesn't exist";
        }

        // Password validation
        if (isset($password)) {
            if (Validate::isEmpty($password))
                $this->alerts['password'] = "*Password is required";
            else if (!Validate::length($password))
                $this->alerts['password'] = "At least 8 character long";
            elseif (!Validate::password($password))
                $this->alerts['password'] = "At least one uppercase,one lowercase and one special character";
        }

        return empty($this->alerts);
    }

    public function getAlerts(): array
    {
        return $this->alerts;
    }
}
