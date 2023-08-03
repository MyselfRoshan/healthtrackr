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
        // $zone = $node->field_mytimezone['und'][0]['value'];

        // $dt = new DateTime();

        // $dt->setTimezone(new DateTimeZone($zone));

        // echo $dt->format('H:i');
        // echo date_default_timezone_set('Asia/Kathmandu');
        // echo date_default_timezone_get();
        // dd(getdate());
        // $this->alerts['fname'] = "*First Name is required" . getdate();
        // Lastname validation
        if (Validate::isEmpty($lname))
            $this->alerts['lname'] = "*Last Name is required";

        // Username validation
        if (Validate::isEmpty($username))
            $this->alerts['username'] = "*Username is required";
        else if (!Validate::username($username))
            $this->alerts['username'] = "Should be alpha numeric eg:john123";
            elseif

        // Email validation
        if (Validate::isEmpty($email))
            $this->alerts['email'] = "*Email is required";
        else if (!Validate::isEmail($email))
            $this->alerts['email'] = "Invalid email!!!";

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
