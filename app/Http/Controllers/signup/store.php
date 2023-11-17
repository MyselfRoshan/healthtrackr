<?php

use App\Http\Forms\SignupForm;
use Database\Database;

extract($_POST);

// If $alerts is found redirect to same page else redirect to login page

$form = new SignupForm();
if (!$form->validate($_POST)) {

    require_view('signup.view.php', [
        'scripts' => [
            'type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"',
            'nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"',
            'src="resources/js/input.js"',
        ],
        'alerts' => $form->getAlerts()
    ]);
} else {
    // $timeZone=json_decode($_COOKIE['timeZone']);
    // Timezone::detect_timezone_id($timeZone->offset, $timeZone->dst);
    // $query = "INSERT INTO public.user(first_name, last_name, username, email, password, last_login)
    // VALUES(:fname,:lname,:username,:email,:password, CURRENT_TIMESTAMP)";
    $query = "INSERT INTO public.user(first_name, last_name, username, email, password, timezone, last_login)
    VALUES(:fname,:lname,:username,:email,:password,:timezone,CURRENT_TIMESTAMP)";
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    $params = [
        'fname' => [$fname, PDO::PARAM_STR],
        'lname' => [$lname, PDO::PARAM_STR],
        'username' => [$username, PDO::PARAM_STR],
        'email' => [$email, PDO::PARAM_STR],
        'password' => [$hashedPassword, PDO::PARAM_STR],
        'timezone' => [$_COOKIE['timeZone'], PDO::PARAM_STR],
    ];
    Database::insert($query, $params);
    redirect('/signin');
}
