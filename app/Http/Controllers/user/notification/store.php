<?php

use App\Models\Email;
use App\Session;

$data = json_decode(file_get_contents('php://input'), true);
// echo $data['exercise_reminder'] ? json_encode($data['exercise_reminder']) : json_encode("failed");
// echo json_encode($data);
$session = Session::getInstance();
if (isset($data['exercise_reminder']) && $data['exercise_reminder'])
    echo json_encode($data);
if (isset($data['sleep_reminder']) && $data['sleep_reminder'])
    echo json_encode($data);
if (isset($data['water_reminder']) && $data['water_reminder']) {
    $html_body = <<<HTMLBody
    <style>
        .header {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #3498db;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #fff;
        }

        .content {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        p {
            margin-bottom: 15px;
            color: #333;
        }

        ul {
            margin-bottom: 15px;
        }

        li {
            margin-left: 20px;
        }

        .signature {
            margin-top: 20px;
            color: #777;
        }
    </style>
    <div class="header" style="background-color: #3498db; padding: 20px; text-align: center;">
        <h1 style="color: #fff;">Stay Hydrated: It's Time to Drink Water!</h1>
    </div>

    <div class="content" style="max-width: 600px; margin: 20px auto; padding: 20px; background-color: #fff; border: 1px solid #ddd; border-radius: 5px;">
        <p>Hi {$session->user['username']},</p>

        <p>We hope you're having a great day! 😊 Just a friendly reminder to stay hydrated by drinking enough water. Proper hydration is essential for your health and well-being.</p>

        <p>Here are a few benefits of staying hydrated:</p>
        <ul>
            <li>Helps maintain overall health</li>
            <li>Supports digestion</li>
            <li>Boosts energy levels</li>
            <li>Enhances skin health</li>
        </ul>

        <p>Take a break now and grab a refreshing glass of water. Your body will thank you!</p>

        <p class="signature">Cheers,<br>
        Health Trackr Team</p>
    </div>

    HTMLBody;
    // mail should be send 8 times a day
    $subject = "Stay Hydrated: It's Time to Drink Water!";
    // date_timezone_set($_COOKIE['timeZone']);
    // echo json_encode($_COOKIE['timeZone']);
    echo $_COOKIE['timeZone'];
    // echo json_encode(date_timezone_get());
    $email = new Email();
    $email->queue($session->user['email'], $subject, $html_body);
    // echo json_encode($data);
} else {
    echo json_encode($data);
}

echo (date('h:i:s', time()));
