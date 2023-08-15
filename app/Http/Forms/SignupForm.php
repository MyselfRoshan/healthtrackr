<?php

namespace App\Http\Forms;

use App\Http\Middleware\Validate;

class SignupForm
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
        // Firstname validation
        if (Validate::isEmpty($fname))
            $this->alerts['fname'] = "*First Name is required";

        // Lastname validation
        if (Validate::isEmpty($lname))
            $this->alerts['lname'] = "*Last Name is required";

        // Username validation
        if (Validate::isEmpty($username))
            $this->alerts['username'] = "*Username is required";
        else if (!Validate::alphaNumeric($username))
            $this->alerts['username'] = "Should be alpha numeric eg:john123";
        elseif (Validate::duplicate('user', 'username', $username))
            $this->alerts['username'] = "User with this username already exists";


        // Email validation
        if (Validate::isEmpty($email))
            $this->alerts['email'] = "*Email is required";
        else if (!Validate::isEmail($email))
            $this->alerts['email'] = "Invalid email!!!";
        elseif (Validate::duplicate('user', 'email', $email))
            $this->alerts['email'] = "User with this email already exists";

        // Password validation
        if (Validate::isEmpty($password))
            $this->alerts['password'] = "*Password is required";
        else if (!Validate::length($password))
            $this->alerts['password'] = "At least 8 character long";
        elseif (!Validate::password($password))
            $this->alerts['password'] = "At least one uppercase,one lowercase and one special character";

        return empty($this->alerts);
    }

    public function getAlerts(): array
    {
        return $this->alerts;
    }
}
