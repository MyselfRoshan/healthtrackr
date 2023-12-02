<?php

use App\Enums\ActivityCategory;
use App\Models\Email;
use App\Session;

$data = json_decode(file_get_contents('php://input'), true);
echo json_encode($data);

$session = Session::getInstance();

$email = new Email();
if (isset($data['exercise_reminder']) && $data['exercise_reminder']) {
    // Morning Exercise
    $email->queue(
        $session->user['id'],
        ActivityCategory::Exercise,
        '06:10',
        '21:50',
        2
    );
} else {
    $email->disableEmailReminder(
        $session->user['id'],
        ActivityCategory::Exercise
    );
}
if (isset($data['sleep_reminder']) && $data['sleep_reminder']) {
    $email->queue(
        $session->user['id'],
        ActivityCategory::Sleep,
        '06:00',
        '21:55',
        2
    );
} else {
    $email->disableEmailReminder(
        $session->user['id'],
        ActivityCategory::Sleep
    );
}

if (isset($data['water_reminder']) && $data['water_reminder']) {
    $email->queue(
        $session->user['id'],
        ActivityCategory::Water,
        '06:05',
        '21:55',
        8
    );
} else {
    $email->disableEmailReminder(
        $session->user['id'],
        ActivityCategory::Water
    );
}
