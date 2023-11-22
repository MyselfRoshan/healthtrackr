<?php

use App\Session;
use Database\Database;

$session = Session::getInstance();
$query = "SELECT date,bed_time,wakeup_time,sleep_duration FROM public.quality_sleep WHERE user_id = :uid";
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
$sleep = [];
function getHourMinute($time)
{
    $value = explode(":", $time, -1);
    return [
        'hour' => $value[0],
        'minute' => $value[1]
    ];
}
foreach ($data as $d) {
    $sleep = [
        ...$sleep,
        $d['date'] => [
            'bed' => getHourMinute($d['bed_time']),
            'wakeup' => getHourMinute($d['wakeup_time']),
            'duration' => getHourMinute($d['sleep_duration'])
        ]
    ];
}
echo json_encode($sleep, JSON_FORCE_OBJECT);
