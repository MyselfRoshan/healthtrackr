<?php

use App\Session;
use Database\Database;

$session = Session::getInstance();
$query = "SELECT date, name, target, actual FROM public.daily_exercise WHERE user_id = :uid";
$params = [
    "uid" => [$session->user['id'], PDO::PARAM_INT]
];
$data = Database::select($query, $params)->fetchAll();
// Demo json that array has to be
// {
//   "2080-07-30": {
//     bed: { hour: 22, minute: 0 },
//     wakeup: { hour: 8, minute: 40 },
//     duration: { hour: 10, minute: 40 },
//   },
// };
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
