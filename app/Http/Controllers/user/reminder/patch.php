<?php

use App\Session;
use Database\Database;

$session = Session::getInstance();
$data = json_decode(file_get_contents('php://input'), true);
// If $alerts is found redirect to same page else redirect to login page

extract($data);
$session = Session::getInstance();
$query = "UPDATE email_reminder
        SET
          start_time = :start_time,
          end_time = :end_time,
          frequency = :frequency,
          sent_count = 0,
          failed_count = 0
        WHERE
          activity_category = :activity_id AND user_id = :id;";

$params = [
  'id' => [$session->user['id'], PDO::PARAM_STR],
  'activity_id' => [$_activity_id, PDO::PARAM_STR],
  'start_time' => [$start_time, PDO::PARAM_STR],
  'end_time' => [$end_time, PDO::PARAM_STR],
  // If frequency is not provided insert 2(i.e. for sleep reminder)
  'frequency' => [$frequency ?? 2, PDO::PARAM_INT]
];
Database::update($query, $params);

// echo json_encode(['hi' => 'hello'], JSON_FORCE_OBJECT);
// echo json_encode($data, JSON_FORCE_OBJECT);
