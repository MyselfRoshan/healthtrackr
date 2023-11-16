<?php

// use App\Session;
// use Database\Database;

// $session = Session::getInstance();
// $query = "SELECT date,bed_time,wakeup_time,sleep_duration FROM public.quality_sleep WHERE user_id = :uid";
// $params = [
//     "uid" => [$session->user['id'], PDO::PARAM_INT]
// ];
// $data = Database::select($query, $params)->fetchAll();

// // {
// //   "2080-07-30": {
// //     bed: { hour: 22, minute: 0 },
// //     wakeup: { hour: 8, minute: 40 },
// //     duration: { hour: 10, minute: 40 },
// //   },
// // };
// $sleep = [];
// function getHourMinute($time)
// {
//     $value = explode(":", $time, -1);
//     return [
//         'hour' => $value[0],
//         'minute' => $value[1]
//     ];
// }
// foreach ($data as $d) {
//     $sleep = [
//         ...$sleep,
//         $d['date'] => [
//             'bed' => getHourMinute($d['bed_time']),
//             'wakeup' => getHourMinute($d['wakeup_time']),
//             'duration' => getHourMinute($d['sleep_duration'])
//         ]
//     ];
// }
// d($sleep);

require_view('user/quality-sleep.view.php', [
    'scripts' => [
        "type='module' src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js'",
        "nomodule src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js'",
        "src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'",
        "src='/resources/js/dashboardSidebar.js'",
        "type='module' src='/resources/js/quality-sleep.js'",
        "src='/resources/js/timepicker.min.js'",
        "src='/resources/js/nepali-datepicker.min.js'",
    ]
]);
