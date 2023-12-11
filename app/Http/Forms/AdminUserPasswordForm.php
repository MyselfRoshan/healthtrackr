<?php

namespace App\Http\Forms;

use App\Http\Middleware\Validate;
use App\Session;

class AdminUserPasswordForm
{
    private array $alerts = [];

    /**
     * @param array $postRequestArray provide $_POST array as an argument
     *
     * @return bool true if validation is sucessful else false
     */
    public function validate(array $postRequestArray, array $getRequestArray): bool
    {
        extract($postRequestArray);
        extract($getRequestArray);

        // Old Password validation
        if (Validate::isEmpty($old_password))
            $this->alerts['old_password'] = "*Old password is required";
        elseif (!Validate::passwordMatchesById($user_id, $old_password))
            $this->alerts['old_password'] = "Old password isn't valid";

        // New password validation
        if (Validate::isEmpty($new_password))
            $this->alerts['new_password'] = "*New password is required";
        elseif (!Validate::length($new_password))
            $this->alerts['new_password'] = "At least 8 character long";
        elseif (!Validate::password($new_password))
            $this->alerts['new_password'] = "At least one uppercase,one lowercase and one special character";

        return empty($this->alerts);
    }

    public function getAlerts(): array
    {
        return $this->alerts;
    }
}
