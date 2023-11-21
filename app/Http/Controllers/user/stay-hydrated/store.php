<?php

use App\Session;
use Database\Database;

$session = Session::getInstance();
$data = json_decode(file_get_contents('php://input'), true);

// Insert the quality sleep data into database and if the primary key is duplicate then update the data from user to database.
$response = [];
foreach ($data as $date => $row) {
    $query = "INSERT INTO public.stay_hydrated(user_id, date, target, intaked)
    VALUES(:uid, :date, :target,:intaked)
    ON CONFLICT (user_id, date)
    DO UPDATE SET target = EXCLUDED.target,
    intaked = EXCLUDED.intaked;";
    $params = [
        'uid' => [$session->user['id'], PDO::PARAM_INT],
        'date' => [$date, PDO::PARAM_STR],
        'target' => [$row['target'], PDO::PARAM_STR],
        'intaked' => [$row['intaked'], PDO::PARAM_STR]
    ];
    Database::insert($query, $params);
}

echo json_encode($data);
