<?php

use App\Helper\Time;
use App\Session;
use Database\Database;

$session = Session::getInstance();

$query = "SELECT activity_category, is_enabled, start_time, end_time, frequency FROM email_reminder WHERE user_id = :id;";
$params = [
    "id" => [$session->user['id'], PDO::PARAM_STR]
];
$reminders = Database::select($query, $params)->fetchAll();
$is_enabled = false;

foreach ($reminders as $reminder) {
    if ($reminder['is_enabled']) {
        $is_enabled = true;
        break;
    }
};
require_view('user/reminder.view.php', [
    'scripts' => [
        "type='module' src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js'",
        "nomodule src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js'",
        "src='/resources/js/jquery.min.js'",
        "src='/resources/js/timepicker.min.js'",
        "src='/resources/js/dashboardSidebar.js'",
        "type='module'src='/resources/js/reminder.js'",
    ],
    'is_enabled' => $is_enabled,
    'reminders' => $reminders
]);
