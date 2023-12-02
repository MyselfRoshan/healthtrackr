<?php

use App\Session;
use Database\Database;

$session = Session::getInstance();
$query = "SELECT is_enabled, activity_category FROM email_reminder WHERE user_id = :uid";
$params = [
    "uid" => [$session->user['id'], PDO::PARAM_INT]
];
$data = Database::select($query, $params)->fetchAll();
$reminder = [];
foreach ($data as $d) {
    $numericValue = $d['activity_category'];
    $activityName = getActivityName($numericValue);

    if ($activityName !== null) {
        $reminder[$activityName] = $d['is_enabled'];
    }
}
function getActivityName($numericValue)
{
    $mapping = [
        0 => 'exercise_reminder',
        1 => 'water_reminder',
        2 => 'food_reminder',
        3 => 'sleep_reminder',
    ];
    return $mapping[$numericValue] ?? null;
}
echo json_encode($reminder, JSON_FORCE_OBJECT);
