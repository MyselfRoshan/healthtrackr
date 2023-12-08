<?php

use App\Http\Forms\ProfilePictureForm;
use App\Session;
use Database\Database;
use App\Helper\Time;

$form = new ProfilePictureForm();
if (!$form->validate($_FILES)) {
    $session = Session::getInstance();
    $query = "SELECT
            first_name,
            last_name,
            username,
            email,
            password,
            last_login,
            created_on,
            timezone,
            (SELECT age FROM profile WHERE user_id = :id) AS age,
            (SELECT weight FROM profile WHERE user_id = :id) AS weight,
            (SELECT height FROM profile WHERE user_id = :id) AS height,
            (SELECT profile_pic FROM profile WHERE user_id = :id) AS profile_pic
          FROM users
          WHERE user_id = :id";
    $params = [
        "id" => [$session->user['id'], PDO::PARAM_STR]
    ];
    $user = Database::select($query, $params)->fetch();

    // d($user);
    $user['age'] = $user['age'] === 0 ? '' : $user['age'];
    $user['height'] = $user['height'] == '0' ? '' : $user['height'];
    $user['weight'] = $user['weight'] === 0 ? '' : $user['weight'];
    $user['last_login'] = Time::ago($user['last_login']);
    $user['created_on'] = getUserDate($user['created_on'], $user['timezone'])->format('jS, F Y');
    $user['profile_pic'] = $user['profile_pic'] ?? "/resources/images/default-profile.png";
    $session->profile_pic = $user['profile_pic'];
    require_view('admin/profile.view.php', [
        'scripts' => [
            "type='module' src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js'",
            "nomodule src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js'",
            "src='/resources/js/profile.js'",
            "src='/resources/js/dashboardSidebar.js'"
        ],
        'user' => $user,
        'alerts' => $form->getAlerts(),
    ]);
} else {
    $upload_dir = BASE_PATH . 'public/uploads/';
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
        redirect("/{$session->user['username']}/profile");
    }
}
