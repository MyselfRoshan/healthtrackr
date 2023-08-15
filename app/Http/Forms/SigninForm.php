<?php

namespace App\Http\Forms;

use App\Http\Middleware\Validate;

class SigninForm
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

        // Username validation
        if (Validate::isEmpty($usrname_email))
            $this->alerts['usrname_email'] = "*Username or email is required";
        elseif (!Validate::userExits($usrname_email))
            $this->alerts['usrname_email'] = "User with this username or email doesn't exist";

        // Email validation

        // Password validation
        if (Validate::isEmpty($password))
            $this->alerts['password'] = "*Password is required";
        elseif (!Validate::passwordMatches($usrname_email, $password))
            $this->alerts['password'] = "Incorrect password";

        return empty($this->alerts);
    }

    public function getAlerts(): array
    {
        return $this->alerts;
    }
}
