<?php

namespace App\Http\Forms;

use App\Http\Middleware\Validate;

class AdminUserAddForm
{
    private array $alerts = [];

    /**
     * @param array $postRequestArray provide $_POST array as an argument
     *
     * @return bool true if validation is sucessful else false
     */
    public function validate(array $postRequestArray, array $fileArray): bool
    {
        extract($postRequestArray);
        extract($fileArray);
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
        elseif (Validate::duplicate('users', 'username', $username))
            $this->alerts['username'] = "User with this username already exists";


        // Email validation
        if (Validate::isEmpty($email))
            $this->alerts['email'] = "*Email is required";
        else if (!Validate::isEmail($email))
            $this->alerts['email'] = "Invalid email!!!";
        elseif (Validate::duplicate('users', 'email', $email))
            $this->alerts['email'] = "User with this email already exists";

        // Password validation
        if (Validate::isEmpty($password))
            $this->alerts['password'] = "*Password is required";
        else if (!Validate::length($password))
            $this->alerts['password'] = "At least 8 character long";
        elseif (!Validate::password($password))
            $this->alerts['password'] = "At least one uppercase, one lowercase and one special character";

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

        // Profile Picture validation
        if ($profile_pic['error'] == UPLOAD_ERR_INI_SIZE)
            $this->alerts['profile_pic'] = "File size exceeds the maximum allowed size (1 MB)";
        elseif ($profile_pic['error'] == UPLOAD_ERR_PARTIAL)
            $this->alerts['profile_pic'] = "The uploaded file was only partially uploaded";
        elseif ($profile_pic['error'] == UPLOAD_ERR_NO_TMP_DIR)
            $this->alerts['profile_pic'] = "Missing a temporary folder";
        elseif ($profile_pic['error'] == UPLOAD_ERR_CANT_WRITE)
            $this->alerts['profile_pic'] = "Failed to write file to disk";
        elseif ($profile_pic['error'] == UPLOAD_ERR_EXTENSION)
            $this->alerts['profile_pic'] = "A PHP extension stopped the file upload";
        elseif ($profile_pic['error'] == UPLOAD_ERR_OK) {
            if ($profile_pic['size'] > 1024 * 1024) {
                $this->alerts['profile_pic'] = "File size exceeds the maximum allowed size (1 MB)";
            } elseif (!in_array($profile_pic['type'], ['image/jpeg', 'image/png', 'image/jpg'])) {
                $this->alerts['profile_pic'] = "Invalid file type. Please upload a JPEG, PNG, or JPG  image";
            } elseif (!getimagesize($profile_pic['tmp_name'])) {
                $this->alerts['profile_pic'] = "Uploaded file is not a valid image";
            }
        }
        return empty($this->alerts);
    }

    public function getAlerts(): array
    {
        return $this->alerts;
    }
}
