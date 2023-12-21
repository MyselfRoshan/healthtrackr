<?php

use App\Session;
use Database\Database;

$session = Session::getInstance();
$data = json_decode(file_get_contents('php://input'), true);
echo json_encode($data);
if (isset($data)) {
    // Insert the quality sleep data into database and if the primary key is duplicate then update the data from user to database.
    $response = [];
    foreach ($data as $date => $meal_types) {
        foreach ($meal_types as $meal_type => $food) {
            $query = "INSERT INTO balanced_nutrition(user_id, date, meal_type, food, target_quantity, actual_quantity)
            VALUES(:uid, :date, :meal_type, :food, :target_quantity, :actual_quantity)
            ON CONFLICT (user_id, date, meal_type)
            DO UPDATE SET
            food = EXCLUDED.food,
            target_quantity = EXCLUDED.target_quantity,
            actual_quantity = EXCLUDED.actual_quantity;";
            $params = [
                'uid' => [$session->user['id'], PDO::PARAM_INT],
                'date' => [$date, PDO::PARAM_STR],
                'meal_type' => [$meal_type, PDO::PARAM_STR],
                'food' => [$food['name'], PDO::PARAM_STR],
                'target_quantity' => [$food['targetQuantity'], PDO::PARAM_INT],
                'actual_quantity' => [$food['actualQuantity'], PDO::PARAM_INT]
            ];
            Database::insert($query, $params);
        }
    }
}
