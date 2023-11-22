<?php

use App\Session;
use Database\Database;

$session = Session::getInstance();
$query = "SELECT date,target,intaked FROM public.stay_hydrated WHERE user_id = :uid";
$params = [
    "uid" => [$session->user['id'], PDO::PARAM_INT]
];
$data = Database::select($query, $params)->fetchAll();
$water = [];
foreach ($data as $d) {
    $water = [
        ...$water,
        $d['date'] => [
            'target' => $d['target'],
            'intaked' => $d['intaked'],
        ]
    ];
}
echo json_encode($water, JSON_FORCE_OBJECT);
