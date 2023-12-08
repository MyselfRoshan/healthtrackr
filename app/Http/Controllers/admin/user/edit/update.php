<?php

use App\Helper\Time;
use App\Http\Forms\AdminUserEditForm;
use Database\Database;

// Extracting variables from $_POST and $_GET
extract($_POST);
extract($_GET);

// If $alerts is found redirect to the same page else redirect to the login page
$userId = intval($user_id);
$form = new AdminUserEditForm();
if (!$form->validate($_POST, $_GET, $_FILES)) {

    // Fetch user data for display
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

    $params = ["id" => [$userId, PDO::PARAM_INT]];
    $user = Database::select($query, $params)->fetch();

    // Handle default values and formatting
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
            "src='/resources/js/user-edit.js'",
        ],
        'user' => $user,
        'alerts' => $form->getAlerts()
    ]);
} else {
    // Update user data
    $query = "UPDATE users
                SET
                  first_name = :fname,
                  last_name = :lname,
                  email = :email,
                  username = :username,
                  timezone = :timezone,
                  is_admin = :is_admin
                WHERE
                  user_id = :id;";

    $params = [
        'id' => [$userId, PDO::PARAM_INT],
        'fname' => [$fname, PDO::PARAM_STR],
        'lname' => [$lname, PDO::PARAM_STR],
        'username' => [$username, PDO::PARAM_STR],
        'email' => [$email, PDO::PARAM_STR],
        'timezone' => [$timezone, PDO::PARAM_STR],
        'is_admin' => [isset($is_admin) ? true : false, PDO::PARAM_BOOL]
    ];

    Database::update($query, $params);

    // For profile picture
    if ($_FILES['profile_pic']['error'] != UPLOAD_ERR_NO_FILE) {
        $upload_dir = BASE_PATH . 'public/uploads/';
        $temp_name = $_FILES['profile_pic']['tmp_name'];
        $img_extension = pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION);
        $new_name = uniqid('IMG-', true) . "." . $img_extension;
        $save_path = $upload_dir . $new_name;
        move_uploaded_file($temp_name, $save_path);
        $database_path = "/uploads/{$new_name}";
    }

    $queryCheck = "SELECT user_id, profile_pic FROM profile WHERE user_id = :id";
    $paramsCheck = ['id' => [$userId, PDO::PARAM_STR]];
    $user = Database::select($queryCheck, $paramsCheck)->fetch();
    if ($user) {
        // User_id exists, perform an update
        if (isset($user['profile_pic']) && $_FILES['profile_pic']['error'] != UPLOAD_ERR_NO_FILE) {
            unlink(BASE_PATH . "public/{$user['profile_pic']}");
        }
        $query = "UPDATE profile
                SET
                  age = :age,
                  height = :height,
                  weight = :weight,
                  profile_pic = :profile_pic

                WHERE
                  user_id = :id;";
    } else {
        // User_id doesn't exist, perform an insert
        $query = "INSERT INTO profile (user_id, age, height, weight, profile_pic)
                VALUES (:id, :age, :height, :weight, :profile_pic);";
    }
    $params = [
        'id' => [$userId, PDO::PARAM_STR],
        'age' => [intval($age), PDO::PARAM_INT],
        'height' => [floatval($height), PDO::PARAM_STR],
        'weight' => [intval($weight), PDO::PARAM_INT],
        'profile_pic' => [$database_path ?? $user['profile_pic'], PDO::PARAM_STR],
    ];

    // Execute the query
    Database::update($query, $params);

    // Redirect to user edit page
    redirect("/admin/user/edit?user_id={$userId}");
}
