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
        if (Validate::isEmpty($email))
            $this->alerts['email'] = "*Email is required";
        elseif (!Validate::userExits($email))
            $this->alerts['email'] = "User with this email doesn't exist";

        return empty($this->alerts);
    }

    public function getAlerts(): array
    {
        return $this->alerts;
    }
}
