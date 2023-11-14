<?php

use App\Session;
use Database\Database;
// extract($_POST);

$upload_dir = BASE_PATH . 'uploads/';
$session = Session::getInstance();
// d($upload_dir);
d($_POST);
d($_FILES['profile_pic']);
$uploaded = false;
$save_path = '';
if ($_FILES['profile_pic']['error'] == UPLOAD_ERR_OK) {
    $temp_name = $_FILES['profile_pic']['tmp_name'];
    $name = basename($_FILES['profile_pic']['name']);
    $save_path = $upload_dir . $name;
    move_uploaded_file($temp_name, $save_path);
    $uploaded = true;
}
if ($uploaded) {
    // $fh = fopen($save_path, 'rb');
    $fh = fopen($upload_dir . $_FILES['profile_pic']['name'], 'rb');
    // $fbytes = fread($fh, filesize($save_path));
    d($fh);
    // Update user last login
    $query = "UPDATE public.user
    SET profile_pic = :profile_pic
    WHERE email = :email";
    $params = [
        ":profile_pic" => [$fh, PDO::PARAM_LOB],
        "email" => [$session->user['email'], PDO::PARAM_STR]
    ];

    d(Database::update($query, $params));
}
