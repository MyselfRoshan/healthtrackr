<?php

use App\Session;
use Database\Database;

$session = Session::getInstance();
$query = "SELECT * FROM balanced_nutrition WHERE user_id = :uid";
$params = [
    "uid" => [$session->user['id'], PDO::PARAM_INT]
];
// Insert the quality sleep data into database and if the primary key is duplicate then update the data from user to database.
$data = Database::select($query, $params)->fetchAll();
$food = [];
$meal = [];
foreach ($data as $d) {
    // set different meal types for same date
    $meal = [
        ...$meal,
        $d['meal_type'] => [
            'name' => $d['food'],
            'targetQuantity' => $d['target_quantity'],
            'actualQuantity' => $d['actual_quantity'],
        ]
    ];
    $food = [
        ...$food,
        $d['date'] => [...$meal]
    ];
}
// echo json_encode($data, JSON_FORCE_OBJECT);
echo json_encode($food, JSON_FORCE_OBJECT);
