<?php

use App\Helper\Time;
use App\Http\Forms\AdminUserPasswordForm;
use Database\Database;

extract($_POST);
extract($_GET);
$form = new AdminUserPasswordForm();
if (!$form->validate($_POST, $_GET)) {
    $query = "SELECT
            first_name,
            last_name,
            username,
            email,
            last_login,
            created_on,
            timezone,
            is_admin,
            (SELECT age FROM profile WHERE user_id = :id) AS age,
            (SELECT weight FROM profile WHERE user_id = :id) AS weight,
            (SELECT height FROM profile WHERE user_id = :id) AS height,
            (SELECT profile_pic FROM profile WHERE user_id = :id) AS profile_pic
          FROM users
          WHERE user_id = :id";
    $params = [
        "id" => [intval($user_id), PDO::PARAM_INT]
    ];
    $user = Database::select($query, $params)->fetch();

    $user['age'] = $user['age'] === 0 ? '' : $user['age'];
    $user['height'] = $user['height'] == '0' ? '' : $user['height'];
    $user['weight'] = $user['weight'] === 0 ? '' : $user['weight'];
    $user['last_login'] = Time::ago($user['last_login']);
    $user['created_on'] = getUserDate($user['created_on'], $user['timezone'])->format('jS, F Y');
    $user['profile_pic'] = $user['profile_pic'] ?? "/resources/images/default-profile.png";

    require_view('admin/user/edit.view.php', [
        'scripts' => [
            "type='module' src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js'",
            "nomodule src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js'",
            "src='/resources/js/dashboardSidebar.js'",
            "src='/resources/js/user-edit.js'",
        ],
        'user' => $user,
        'alerts' => $form->getAlerts()
    ]);
} else {
    $query = "UPDATE users SET password = :password WHERE user_id = :id;";
    $hashedPassword = password_hash($new_password, PASSWORD_BCRYPT, ['cost' => 12]);
    $params = [
        'id' => [$user_id, PDO::PARAM_STR],
        'password' => [$hashedPassword, PDO::PARAM_STR]
    ];
    Database::update($query, $params);

    redirect("/admin/user/edit?user_id={$user_id}");
}
