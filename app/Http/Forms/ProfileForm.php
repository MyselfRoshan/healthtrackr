<?php

namespace App\Http\Forms;

use App\Http\Middleware\Validate;
use App\Session;

class ProfileForm
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
        $session = Session::getInstance();
        if (Validate::isEmpty($username))
            $this->alerts['username'] = "*Username is required";
        else if (!Validate::alphaNumeric($username))
            $this->alerts['username'] = "Should be alpha numeric eg:john123";
        elseif (Validate::isValueTaken('users', 'username', $username, 'user_id', $session->user['id']))
            $this->alerts['username'] = "User with this username already exists";

        // Email validation
        if (Validate::isEmpty($email))
            $this->alerts['email'] = "*Email is required";
        else if (!Validate::isEmail($email))
            $this->alerts['email'] = "Invalid email!!!";
        elseif (Validate::isValueTaken('users', 'email', $email, 'user_id', $session->user['id']))
            $this->alerts['email'] = "User with this email already exists";

        // Password validation
        // if (Validate::isEmpty($password))
        //     $this->alerts['password'] = "*Password is required";
        // else if (!Validate::length($password))
        //     $this->alerts['password'] = "At least 8 character long";
        // elseif (!Validate::password($password))
        //     $this->alerts['password'] = "At least one uppercase,one lowercase and one special character";

        // Age validation
        if (Validate::isEmpty($age))
            $age = null;
        elseif (!Validate::isIntegerInRange($age, 10, 80))
            $this->alerts['age'] = "Please enter a valid age between 10 and 80 years.";


        // Height validation
        if (Validate::isEmpty($height))
            $height = null;
        elseif (!Validate::isNumericInRange($height, 3, 8))
            $this->alerts['height'] = "Please enter a valid height between 3 feet 5 inches and 8 feet.";


        // Weight validation
        if (Validate::isEmpty($weight))
            $weight = null;
        elseif (!Validate::isIntegerInRange($weight, 23, 136))
            $this->alerts['weight'] = "Please enter a valid weight between 23 and 136 kg.";
        // d($_POST);
        return empty($this->alerts);
    }

    public function getAlerts(): array
    {
        return $this->alerts;
    }
}
