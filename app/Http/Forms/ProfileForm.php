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

        // Height validation
        if (Validate::isEmpty($height))
            $height = null;
        elseif (!Validate::isIntegerInRange($height, 100, 250))
            $this->alerts['height'] = "Please enter a valid height between 100 and 250 cm.";

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
