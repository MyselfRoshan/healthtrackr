<?php

use App\Http\Forms\SignupForm;
use Database\Database;

extract($_POST);

// If $alerts is found redirect to same page else redirect to login page

$form = new SignupForm();
if (!$form->validate($_POST)) {

    require_view('signup.view.php', [
        'scripts' => [
            "type='module' src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js'",
            "nomodule src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js'",
            "src='/resources/js/input.js'",
        ],
        'alerts' => $form->getAlerts()
    ]);
}

// $query = "SELECT * FROM user;";
// dd(Database::select($query)->fetchAll());
// $query = "INSERT INTO public.user(first_name, last_name, username, email, password, created_on) VALUES(:fname,:lname,:username,:email,:password, NOW()";
$query = "INSERT INTO public.user(first_name, last_name, username, email, password) VALUES(:fname,:lname,:username,:email,:password)";
$hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
$params = [
    'fname' => [$fname, PDO::PARAM_STR],
    'lname' => [$lname, PDO::PARAM_STR],
    'username' => [$username, PDO::PARAM_STR],
    'email' => [$email, PDO::PARAM_STR],
    'password' => [$hashedPassword, PDO::PARAM_STR],
    // 'created_on' => [NOW, PDO::PARAM_STR]
];
Database::insert($query, $params);
header('location: /signin');
die();
