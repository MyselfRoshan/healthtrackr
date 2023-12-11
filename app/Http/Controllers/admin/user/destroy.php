<?php

use App\Session;
use Database\Database;

$session = Session::getInstance();
$data = json_decode(file_get_contents('php://input'), true);

// echo json_encode($data);
$query = "DELETE FROM users WHERE user_id = :id";
$params = [
    "id" => [$data['id'], PDO::PARAM_STR]
];
$user = Database::delete($query, $params);

echo json_encode(['sucessful' => $user ? true : false]);
