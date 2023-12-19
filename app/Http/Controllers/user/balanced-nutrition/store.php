<?php

use App\Session;
use Database\Database;

$session = Session::getInstance();
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data)) {

    // echo json_encode($data);

    //     {
    //     "2080/09/02": {
    //         "breakfast": {
    //             "name": "Dal Bhat",
    //             "quantity": 1
    //         },
    //         "dinner": {
    //             "name": "Buff Momo",
    //             "quantity": 1
    //         },
    //         "snack": {
    //             "name": "Sel Roti",
    //             "quantity": 4
    //         },
    //         "launch": {
    //             "name": "Dal Bhat",
    //             "quantity": 1
    //         }
    //     }
    // }
    // Insert the quality sleep data into database and if the primary key is duplicate then update the data from user to database.
    $response = [];
    foreach ($data as $date => $meal_types) {
        foreach ($meal_types as $meal_type => $food) {
            $query = "INSERT INTO balanced_nutrition(user_id, date, meal_type, food, quantity)
            VALUES(:uid, :date, :meal_type, :food, :quantity)
            ON CONFLICT (user_id, date, meal_type)
            DO UPDATE SET
            food = EXCLUDED.food,
            quantity = EXCLUDED.quantity;";
            $params = [
                'uid' => [$session->user['id'], PDO::PARAM_INT],
                'date' => [$date, PDO::PARAM_STR],
                'meal_type' => [$meal_type, PDO::PARAM_STR],
                'food' => [$food['name'], PDO::PARAM_STR],
                'quantity' => [$food['quantity'], PDO::PARAM_INT]
            ];
            Database::insert($query, $params);
        }
    }
}
