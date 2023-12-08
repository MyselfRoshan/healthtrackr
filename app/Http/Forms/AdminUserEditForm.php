<?php

namespace App\Http\Forms;

use App\Http\Middleware\Validate;
use App\Session;

class AdminUserEditForm
{
    private array $alerts = [];

    /**
     * @param array $postRequestArray provide $_POST array as an argument
     *
     * @return bool true if validation is sucessful else false
     */
    public function validate(array $postRequestArray, array $getRequestArray, array $fileArray): bool
    {
        extract($postRequestArray);
        extract($getRequestArray);
        extract($fileArray);

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
        elseif (Validate::isValueTaken('users', 'username', $username, 'user_id', $user_id))
            $this->alerts['username'] = "User with this username already exists";

        // Email validation
        if (Validate::isEmpty($email))
            $this->alerts['email'] = "*Email is required";
        else if (!Validate::isEmail($email))
            $this->alerts['email'] = "Invalid email!!!";
        elseif (Validate::isValueTaken('users', 'email', $email, 'user_id', $user_id))
            $this->alerts['email'] = "User with this email already exists";

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
