<?php

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
            -- password,
            last_login,
            created_on,
            timezone,
            profile_pic,
            (SELECT age FROM public.profile WHERE user_id = :id) AS age,
            (SELECT weight FROM public.profile WHERE user_id = :id) AS weight,
            (SELECT height FROM public.profile WHERE user_id = :id) AS height
          FROM
            public.user
          WHERE
            user_id = :id";
    $params = [
        "id" => [$session->user['id'], PDO::PARAM_STR]
    ];
    $user = Database::select($query, $params)->fetch();
    // $user['first_name'] = $fname;
    // $user['last_name'] = $lname;
    // $user['username'] = $username;
    // $user['email'] = $email;
    $user['last_login'] = timeago($user['last_login']);
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
    // d($_POST);
    // $timeZone=json_decode($_COOKIE['timeZone']);
    // Timezone::detect_timezone_id($timeZone->offset, $timeZone->dst);
    $query = "UPDATE public.user
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
    // if (intval($age) && intval($age) && intval($age)) {

    // $query = "INSERT INTO public.profile (user_id, age, height, weight)
    // VALUES (:id, :age, :height, :weight)
    // ON CONFLICT (user_id)
    // DO UPDATE SET
    //   age = EXCLUDED.age,
    //   height = EXCLUDED.height,
    //   weight = EXCLUDED.weight;";

    // $params = [
    //     'id' => [$session->user['id'], PDO::PARAM_STR],
    //     'age' => [intval($age), PDO::PARAM_INT],
    //     'height' => [floatval($height), PDO::PARAM_STR],
    //     'weight' => [intval($weight), PDO::PARAM_INT],
    // ];
    // Database::update($query, $params);

    $queryCheck = "SELECT user_id FROM public.profile WHERE user_id = :id";
    $paramsCheck = ['id' => [$session->user['id'], PDO::PARAM_STR]];
    $result = Database::select($queryCheck, $paramsCheck)->fetch();
    // d($result);
    if ($result) {
        // User_id exists, perform an update
        $query = "UPDATE public.profile
        SET
          age = :age,
          height = :height,
          weight = :weight
        WHERE
          user_id = :id;
    ";
    } else {
        // User_id doesn't exist, perform an insert
        $query = "INSERT INTO public.profile (user_id, age, height, weight)
        VALUES (:id, :age, :height, :weight);
    ";
    }

    // Common parameters

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