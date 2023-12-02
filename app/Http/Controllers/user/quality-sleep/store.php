<?php

use App\Session;
use Database\Database;

$session = Session::getInstance();
$data = json_decode(file_get_contents('php://input'), true);

// Insert the quality sleep data into database and if the primary key is duplicate then update the data from user to database.
foreach ($data as $date => $row) {
    $bed_time = "{$row['bed']['hour']}:{$row['bed']['minute']}";
    $wakeup_time = "{$row['wakeup']['hour']}:{$row['wakeup']['minute']}";
    $sleep_duration = "{$row['duration']['hour']}:{$row['duration']['minute']}";

    $query = "INSERT INTO quality_sleep(user_id, bed_time, wakeup_time, sleep_duration, date)
        VALUES(:uid,:bed_time,:wakeup_time,:sleep_duration,:date)
        ON CONFLICT (user_id, date)
        DO UPDATE SET bed_time = EXCLUDED.bed_time,
                  wakeup_time = EXCLUDED.wakeup_time,
                  sleep_duration = EXCLUDED.sleep_duration;";
    $params = [
        'uid' => [$session->user['id'], PDO::PARAM_INT],
        'date' => [$date, PDO::PARAM_STR],
        'bed_time' => [$bed_time, PDO::PARAM_STR],
        'wakeup_time' => [$wakeup_time, PDO::PARAM_STR],
        'sleep_duration' => [$sleep_duration, PDO::PARAM_STR]
    ];
    Database::insert($query, $params);
}
