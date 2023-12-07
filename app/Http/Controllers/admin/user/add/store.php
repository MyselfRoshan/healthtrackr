<?php

use App\Http\Forms\AdminUserAddForm;
use Database\Database;

extract($_POST);
/* To Do insert the profile pic by viewing the profile pic from updat.php method in /profile */
// d($_FILES['profile_pic']);
// d($_POST);
// If $alerts is found redirect to same page else redirect to login page

$form = new AdminUserAddForm();
if (!$form->validate($_POST)) {

    require_view('admin/user/add.view.php', [
        'scripts' => [
            "type='module' src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js'",
            "nomodule src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js'",
            "src='/resources/js/dashboardSidebar.js'",
            "src='/resources/js/profile.js'",
            "src='/resources/js/user-add.js'",
        ],
        'alerts' => $form->getAlerts(),
        'user' => $_POST
    ]);
} else {
    $query = "INSERT INTO users(first_name, last_name, username, email, password, timezone, is_admin)
    VALUES(:fname, :lname, :username, :email, :password, :timezone), is_admin;";

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

    $params = [
        'fname' => [$fname, PDO::PARAM_STR],
        'lname' => [$lname, PDO::PARAM_STR],
        'username' => [$username, PDO::PARAM_STR],
        'email' => [$email, PDO::PARAM_STR],
        'password' => [$hashedPassword, PDO::PARAM_STR],
        'timezone' => [$timezone, PDO::PARAM_STR],
        'is_admin' => [isset($is_admin) ? true : false, PDO::PARAM_BOOL],
    ];

    $userResult = Database::insert($query, $params);

    if ($userResult) {
        // Assuming you have the corresponding data for the profile table
        $profileQuery = "INSERT INTO profile(user_id, age, height, weight)
        VALUES((SELECT user_id FROM users WHERE username = :username), :age, :height, :weight);";

        $profileParams = [
            'username' => [$username, PDO::PARAM_STR],
            'age' => [intval($age), PDO::PARAM_INT],
            'height' => [$height, PDO::PARAM_STR],
            'weight' => [intval($weight), PDO::PARAM_INT],
        ];

        Database::insert($profileQuery, $profileParams);

        redirect('/admin/user/add');
    }
}
