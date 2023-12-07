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
    // Delete previous profile picture
    $query = "SELECT profile_pic FROM profile WHERE user_id = :id";
    $params = [
        "id" => [$session->user['id'], PDO::PARAM_STR]
    ];
    $user = Database::select($query, $params)->fetch();
    if (isset($user['profile_pic']))
        unlink(BASE_PATH . "public/{$user['profile_pic']}");

    // Add new uploaded profile picture
    $queryCheck = "SELECT user_id FROM profile WHERE user_id = :id";
    $paramsCheck = ['id' => [$session->user['id'], PDO::PARAM_STR]];
    $result = Database::select($queryCheck, $paramsCheck)->fetch();
    if ($result) {
        // User_id exists, perform an update
        $query = "UPDATE profile
    SET profile_pic = :profile_pic
    WHERE user_id = :id";
        $params = [
            "profile_pic" => ["/uploads/{$new_name}", PDO::PARAM_STR],
            "id" => [$session->user['id'], PDO::PARAM_STR]
        ];

        Database::update($query, $params);
    } else {
        // User_id doesn't exist, perform an insert
        $query = "INSERT INTO profile (user_id, profile_pic)
        VALUES (:id, :profile_pic);";
        $params = [
            "profile_pic" => ["/uploads/{$new_name}", PDO::PARAM_STR],
            "id" => [$session->user['id'], PDO::PARAM_STR]
        ];

        Database::update($query, $params);
    }
    redirect("/admin/profile");
}
