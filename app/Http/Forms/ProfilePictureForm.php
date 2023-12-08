<?php

namespace App\Http\Forms;

class ProfilePictureForm
{
    private array $alerts = [];

    /**
     * @param array $postRequestArray provide $_POST array as an argument
     *
     * @return bool true if validation is sucessful else false
     */
    public function validate(array $fileArray): bool
    {
        extract($fileArray);
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
