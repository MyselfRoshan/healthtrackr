<?php

use App\Session;
use Database\Database;
// extract($_POST);

$upload_dir = BASE_PATH . 'public/uploads/';
$session = Session::getInstance();
$uploaded = false;
$save_path = '';
if ($_FILES['profile_pic']['error'] == UPLOAD_ERR_OK) {
    $temp_name = $_FILES['profile_pic']['tmp_name'];
    $name = basename($_FILES['profile_pic']['name']);
    $img_extension = pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION);
    $new_name = uniqid('IMG-', true) . "." . $img_extension;
    $save_path = $upload_dir . $new_name;
    move_uploaded_file($temp_name, $save_path);
    $uploaded = true;
}
if ($uploaded) {
    $query = "UPDATE public.user
    SET profile_pic = :profile_pic
    WHERE email = :email";
    $params = [
        ":profile_pic" => ["/uploads/{$new_name}", PDO::PARAM_STR],
        "email" => [$session->user['email'], PDO::PARAM_STR]
    ];

    Database::update($query, $params);
    redirect("/{$session->user['username']}/profile");
}
