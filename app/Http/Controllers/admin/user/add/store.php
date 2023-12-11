<?php

use App\Http\Forms\AdminUserAddForm;
use Database\Database;

// Extracting variables from $_POST
extract($_POST);

$form = new AdminUserAddForm();

if (!$form->validate($_POST, $_FILES)) {
    // Display the add user form with alerts
    require_view('admin/user/add.view.php', [
        'scripts' => [
            "type='module' src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js'",
            "nomodule src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js'",
            "src='/resources/js/nepali-datepicker.min.js'",
            "type='module' src='/resources/js/profile.js'",
            "src='/resources/js/dashboardSidebar.js'",
            "src='/resources/js/user-add.js'",
        ],
        'alerts' => $form->getAlerts(),
        'user' => $_POST
    ]);
} else {
    // Insert new user data into the 'users' table
    $query = "INSERT INTO users(first_name, last_name, username, email, password, timezone, is_admin)
    VALUES(:fname, :lname, :username, :email, :password, :timezone, :is_admin);";

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
        // Insert profile data into the 'profile' table
        $profileQuery = "INSERT INTO profile(user_id, height, weight" . (!empty($dob) ? ", dob" : "");
        $profileValues = "VALUES((SELECT user_id FROM users WHERE username = :username), :height, :weight"
            . (!empty($dob) ? ", :dob" : "");

        if (!empty($dob))
            $profileParams['dob'] = [$dob, PDO::PARAM_STR];

        if ($_FILES['profile_pic']['error'] != UPLOAD_ERR_NO_FILE) {
            // Handle profile picture upload
            $upload_dir = BASE_PATH . 'public/uploads/';
            $temp_name = $_FILES['profile_pic']['tmp_name'];
            $img_extension = pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION);
            $new_name = uniqid('IMG-', true) . "." . $img_extension;
            $save_path = $upload_dir . $new_name;
            move_uploaded_file($temp_name, $save_path);

            $profileQuery .= ", profile_pic";
            $profileValues .= ", :profile_pic";

            $profileParams = [
                'profile_pic' => ["/uploads/{$new_name}", PDO::PARAM_STR],
            ];
        }

        $profileQuery .= ")";
        $profileValues .= ");";

        $profileParams['username'] = [$username, PDO::PARAM_STR];
        $profileParams['height'] = [intval($height), PDO::PARAM_INT];
        $profileParams['weight'] = [intval($weight), PDO::PARAM_INT];

        Database::insert($profileQuery . $profileValues, $profileParams);

        // Redirect after successful user addition
        redirect('/admin/user/add');
    }
}
