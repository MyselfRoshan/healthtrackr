<?php

// echo "Hello";

use App\Http\Middleware\Validate;
use Database\Database;

extract($_POST);
// Firstname validation
if (Validate::isEmpty($fname))
    // $alerts['fname'] = "*First Name is required" . date('Y-m-d H:m:i');
    // $zone = $node->field_mytimezone['und'][0]['value'];

    // $dt = new DateTime();

    // $dt->setTimezone(new DateTimeZone($zone));

    echo $dt->format('H:i');
echo date_default_timezone_set('Asia/Kathmandu');
echo date_default_timezone_get();
dd(getdate());
// $alerts['fname'] = "*First Name is required" . getdate();
// Lastname validation
if (Validate::isEmpty($lname))
    $alerts['lname'] = "*Last Name is required";
// Username validation
if (Validate::isEmpty($username))
    $alerts['username'] = "*Username is required";
else if (!Validate::username($username))
    $alerts['username'] = "Should be alpha numeric eg:john123";
// Email validation
if (Validate::isEmpty($email))
    $alerts['email'] = "*Email is required";
else if (!Validate::isEmail($email))
    $alerts['email'] = "Invalid email!!!";
// Password validation
if (Validate::isEmpty($password))
    $alerts['password'] = "*Password is required";
else if (!Validate::length($password))
    $alerts['password'] = "At least 8 character long";
elseif (!Validate::password($password))
    $alerts['password'] = "At least one uppercase,one lowercase and one special character";

// If $alerts is found redirect to same page else redirect to login page
if (!empty($alerts)) {
    require_view('signup.view.php', [
        'scripts' => [
            "type='module' src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js'",
            "nomodule src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js'",
            "src='/resources/js/input.js'",
        ],
        'alerts' => $alerts,
    ]);
}

//  else {
//     $query = "INSERT public.user(first_name, last_name, username, email, password, created_on) VALUES(:fname,:lname,:username,:email,:password,:created_on)";
//     $createdOn =
//         $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
//     $params = [
//         'fname' => [$fname, PDO::PARAM_STR],
//         'lname' => [$lname, PDO::PARAM_STR],
//         'username' => [$username, PDO::PARAM_STR],
//         'email' => [$email, PDO::PARAM_STR],
//         'password' => [$hashedPassword, PDO::PARAM_STR],
//         'created_on' => [$createdOn, PDO::PARAM_STR]
//     ];
//     Database::insert($query, $params);
//     header('location: /signin');
//     die();
// }
