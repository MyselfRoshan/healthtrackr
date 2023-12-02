<?php

use App\Session;
use Database\Database;

$session = Session::getInstance();
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data)) {

    // echo json_encode($data);

    // Insert the quality sleep data into database and if the primary key is duplicate then update the data from user to database.
    $response = [];
    foreach ($data as $date => $row) {
        $query = "INSERT INTO daily_exercise(user_id, date, name, target, actual)
        VALUES(:uid, :date, :name, :target, :actual)
        ON CONFLICT (user_id, date)
        DO UPDATE SET
        name = EXCLUDED.name,
        target = EXCLUDED.target,
        actual = EXCLUDED.actual;";
        $params = [
            'uid' => [$session->user['id'], PDO::PARAM_INT],
            'date' => [$date, PDO::PARAM_STR],
            'name' => [$row['name'], PDO::PARAM_STR],
            'target' => [$row['target'], PDO::PARAM_STR],
            'actual' => [$row['actual'], PDO::PARAM_STR]
        ];
        Database::insert($query, $params);
    }
}
echo json_encode($_POST);
// echo json_encode("ho");
// echo "ho";
