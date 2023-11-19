<?php

$data = json_decode(file_get_contents('php://input'), true);
// echo $data['exercise_notification'] ? json_encode($data['exercise_notification']) : json_encode("failed");
echo json_encode($data);
