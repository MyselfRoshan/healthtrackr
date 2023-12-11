<?php

namespace App\Http\Forms;

use App\Http\Middleware\Validate;

class SigninForm
{
    protected array $alerts = [];

    /**
     * @param array $postRequestArray provide $_POST array as an argument
     *
     * @return bool true if validation is sucessful else false
     */
    public function validate(array $postRequestArray): bool
    {
        extract($postRequestArray);

        // Username or email validation
        if (Validate::isEmpty($usrname_email))
            $this->alerts['usrname_email'] = "*Username or email is required";
        elseif (!Validate::userExits($usrname_email))
            $this->alerts['usrname_email'] = "Username or email doesn't exist";

        // Password validation
        if (Validate::isEmpty($password))
            $this->alerts['password'] = "*Password is required";
        else if (Validate::userExits($usrname_email) && !Validate::length($password))
            $this->alerts['password'] = "Incorrect password";
        elseif (Validate::userExits($usrname_email) && !Validate::password($password))
            $this->alerts['password'] = "Incorrect password";
        elseif (Validate::isEmpty($usrname_email) && !Validate::isEmpty($password))
            $this->alerts['usrname_email'] = "*Username or email is required";
        elseif (Validate::userExits($usrname_email) && !Validate::passwordMatches($usrname_email, $password))
            $this->alerts['password'] = "Incorrect password";

        return empty($this->alerts);
    }

    public function getAlerts(): array
    {
        return $this->alerts;
    }
}
