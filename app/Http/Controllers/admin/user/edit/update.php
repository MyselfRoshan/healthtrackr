<?php

use App\Helper\Time;
use App\Http\Forms\AdminUserEditForm;
use Database\Database;

extract($_POST);
extract($_GET);
// d($_POST);
// If $alerts is found redirect to same page else redirect to login page
$form = new AdminUserEditForm();
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
    $user['weight'] = $user['weight'] == '0' ? '' : $user['weight'];
    $user['last_login'] = Time::ago($user['last_login']);
    $user['created_on'] = getUserDate($user['created_on'], $user['timezone'])->format('jS, F Y');
    $user['profile_pic'] = $user['profile_pic'] ?? "/resources/images/default-profile.png";

    require_view('admin/user/edit.view.php', [
        'scripts' => [
            "type='module' src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js'",
            "nomodule src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js'",
            "src='/resources/js/dashboardSidebar.js'",
            "type='module' src='/resources/js/admin-user.js'",
            "src='/resources/js/profile.js'",
            "src='/resources/js/user-edit.js'",
        ],
        'user' => $user,
        'alerts' => $form->getAlerts()
    ]);
} else {
    $query = "UPDATE users
                SET
                  first_name = :fname,
                  last_name = :lname,
                  email = :email,
                  username = :username,
                  is_admin = :is_admin
                WHERE
                  user_id = :id;";
    $params = [
        'id' => [$user_id, PDO::PARAM_INT],
        'fname' => [$fname, PDO::PARAM_STR],
        'lname' => [$lname, PDO::PARAM_STR],
        'username' => [$username, PDO::PARAM_STR],
        'email' => [$email, PDO::PARAM_STR],
        'is_admin' => [isset($is_admin) ? true : false, PDO::PARAM_BOOL]
    ];
    Database::update($query, $params);

    $queryCheck = "SELECT user_id FROM profile WHERE user_id = :id";
    $paramsCheck = ['id' => [$user_id, PDO::PARAM_STR]];
    $result = Database::select($queryCheck, $paramsCheck)->fetch();
    if ($result) {
        // User_id exists, perform an update
        $query = "UPDATE profile
                SET
                  age = :age,
                  height = :height,
                  weight = :weight
                WHERE
                  user_id = :id;
            ";
    } else {
        // User_id doesn't exist, perform an insert
        $query = "INSERT INTO profile (user_id, age, height, weight)
                VALUES (:id, :age, :height, :weight);";
    }
    $params = [
        'id' => [$user_id, PDO::PARAM_STR],
        'age' => [intval($age), PDO::PARAM_INT],
        'height' => [floatval($height), PDO::PARAM_STR],
        'weight' => [intval($weight), PDO::PARAM_INT],
    ];

    // Execute the query
    Database::update($query, $params);

    //     redirect("/{$session->user['username']}/profile");
    redirect("/admin/user/edit?user_id={$user_id}");
}
