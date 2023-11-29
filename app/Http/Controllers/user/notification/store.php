<?php

use App\Models\Email;
use App\Session;

$data = json_decode(file_get_contents('php://input'), true);
// echo $data['exercise_reminder'] ? json_encode($data['exercise_reminder']) : json_encode("failed");
// echo json_encode($data);

$session = Session::getInstance();
// require should be below $session as it is used inside email_data.php
require base_path("config/email_data.php");

$email = new Email();
if (isset($data['exercise_reminder']) && $data['exercise_reminder']) {
    // Morning Exercisw
    $email->queue(
        $session->user['email'],
        $EMAIL['exercise']['subject'],
        $EMAIL['exercise']['body'],
        '6:10'
    );

    // Evening Exercisw
    $email->queue(
        $session->user['email'],
        $EMAIL['exercise']['subject'],
        $EMAIL['exercise']['body'],
        '21:50'
    );
} else {
    echo json_encode($data);
}
if (isset($data['sleep_reminder']) && $data['sleep_reminder']) {
    // Bed Time
    $email->queue(
        $session->user['email'],
        $EMAIL['sleep']['subject'],
        $EMAIL['sleep']['body'],
        '6:10'
    );

    // Evening Time
    $email->queue(
        $session->user['email'],
        $EMAIL['sleep']['subject'],
        $EMAIL['sleep']['body'],
        '21:50'
    );
} else {
    echo json_encode($data);
}

if (isset($data['water_reminder']) && $data['water_reminder']) {
    // date_timezone_set($_COOKIE['timeZone']);

    // mail should be send 8 times a day
    $start_time = '06:05';
    $end_time = '21:55';
    $repeat_count = 8;

    $scheduleTimeStamps = generateTimeArray($start_time, $end_time, $repeat_count);
    for ($i = 0; $i < $repeat_count; $i++)
        $email->queue(
            $session->user['email'],
            $EMAIL['water']['subject'],
            $EMAIL['water']['body'],
            $scheduleTimeStamps[$i]
        );
} else {
    /** TO DO
     *  Delete all the notification of type water using type and email column from database
     */
}
// echo json_encode($data);