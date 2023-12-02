<?php

use App\Session;
use Database\Database;

$session = Session::getInstance();
$query = "SELECT date, name, target, actual FROM daily_exercise WHERE user_id = :uid";
$params = [
    "uid" => [$session->user['id'], PDO::PARAM_INT]
];
$data = Database::select($query, $params)->fetchAll();
$exercise = [];
foreach ($data as $d) {
    $exercise = [
        ...$exercise,
        $d['date'] => [
            'name' => $d['name'],
            'target' => $d['target'],
            'actual' => $d['actual'],
        ]
    ];
}
echo json_encode($exercise, JSON_FORCE_OBJECT);
