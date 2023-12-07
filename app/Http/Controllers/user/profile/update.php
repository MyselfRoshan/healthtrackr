<?php

use App\Helper\Time;
use App\Http\Forms\ProfileForm;
use App\Session;
use Database\Database;

extract($_POST);

// If $alerts is found redirect to same page else redirect to login page

$form = new ProfileForm();
$session = Session::getInstance();

if (!$form->validate($_POST)) {
  $query = "SELECT
            first_name,
            last_name,
            username,
            email,
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
  $user['age'] = $user['age'] === 0 ? '' : $user['age'];
  $user['height'] = $user['height'] == '0' ? '' : $user['height'];
  $user['weight'] = $user['weight'] === 0 ? '' : $user['weight'];

  $user['last_login'] = Time::ago($user['last_login']);
  $user['created_on'] = getUserDate($user['created_on'], $user['timezone'])->format('jS, F Y');
  $user['profile_pic'] = $user['profile_pic'] ?? "/resources/images/default-profile.png";
  $session->profile_pic = $user['profile_pic'];
  require_view('user/profile.view.php', [
    'scripts' => [
      "type='module' src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js'",
      "nomodule src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js'",
      "src='/resources/js/input.js'",
      "src='/resources/js/profile.js'",
      "src='/resources/js/dashboardSidebar.js'"
    ],
    'alerts' => $form->getAlerts(),
    'user' => $user
  ]);
} else {
  $query = "UPDATE users
        SET
          first_name = :fname,
          last_name = :lname,
          email = :email,
          username = :username
        WHERE
          user_id = :id;";

  $params = [
    'id' => [$session->user['id'], PDO::PARAM_STR],
    'fname' => [$fname, PDO::PARAM_STR],
    'lname' => [$lname, PDO::PARAM_STR],
    'username' => [$username, PDO::PARAM_STR],
    'email' => [$email, PDO::PARAM_STR]
  ];
  Database::update($query, $params);
  $session->user = [
    'id' => $session->user['id'],
    'username' => $username,
    'email' => $email,
  ];

  $queryCheck = "SELECT user_id FROM profile WHERE user_id = :id";
  $paramsCheck = ['id' => [$session->user['id'], PDO::PARAM_STR]];
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
    'id' => [$session->user['id'], PDO::PARAM_STR],
    'age' => [intval($age), PDO::PARAM_INT],
    'height' => [floatval($height), PDO::PARAM_STR],
    'weight' => [intval($weight), PDO::PARAM_INT],
  ];

  // Execute the query
  Database::update($query, $params);

  redirect("/{$session->user['username']}/profile");
}
