<?php

declare(strict_types=1);

use App\Enums\ActivityCategory;
use App\Helper\Mail;
use App\Models\Email;

require_once __DIR__ . '/../vendor/autoload.php';
const BASE_PATH = __DIR__ . "/../";
require BASE_PATH . "config/bootstrap.php";

echo "cron is working\n";

// Set the default timezone
date_default_timezone_set('Asia/Kathmandu');

$email = new Email();
$enabledEmails = $email->getAllEnabledEmailReminders();

// Function to send emails
function sendEmail($user, $subject, $body, $email, $enabledEmailId)
{
    $m = new Mail($user['email'], $subject, $body);
    $result = $m->send();

    if ($result) {
        $email->decreasePendingCount($enabledEmailId);
        $email->increaseSentCount($enabledEmailId);
    } else {
        $email->increaseFailedCount($enabledEmailId);
    }
}

foreach ($enabledEmails as $enabledEmail) {
    $pendingCount = $enabledEmail['frequency'] - intval($enabledEmail['sent_count']) - intval($enabledEmail['failed_count']);

    // Update pending count based on the current time
    if ((new DateTime())->format('H:i') !== "11:48") {
        $email->updatePendingCount($enabledEmail['id'], $pendingCount);
    } else {
        $email->updatePendingCount($enabledEmail['id'], $enabledEmail['frequency']);
        $email->updateFailedCount($enabledEmail['id'], 0);
        $email->updateSentCount($enabledEmail['id'], 0);
    }

    $users = $email->getRecipient($enabledEmail['user_id']);
    $now = new DateTime();

    switch (intval($enabledEmail['activity_category'])) {
        case ActivityCategory::Exercise->value:
            $scheduleTimeStamps = generateTimeArray($enabledEmail['start_time'], $enabledEmail['end_time'], $enabledEmail['frequency']);
            foreach ($scheduleTimeStamps as $scheduleTimeStamp) {
                $scheduledTime = new DateTime($scheduleTimeStamp);
                $timeDifference = $now->diff($scheduledTime);

                foreach ($users as $user) {
                    require base_path("config/email_data.php");
                    $hour = intval($now->format('H'));

                    if ($hour <= 11 && $scheduledTime <= $now && $timeDifference->i <= 0.5) {
                        sendEmail($user, $EMAIL['morning_exercise']['subject'], $EMAIL['morning_exercise']['body'], $email, $enabledEmail['id']);
                    } elseif ($hour > 11 && $hour < 18 && $scheduledTime <= $now && $timeDifference->i <= 0.5) {
                        sendEmail($user, $EMAIL['exercise']['subject'], $EMAIL['exercise']['body'], $email, $enabledEmail['id']);
                    } elseif ($hour >= 18 && $scheduledTime <= $now && $timeDifference->i <= 0.5) {
                        sendEmail($user, $EMAIL['night_exercise']['subject'], $EMAIL['night_exercise']['body'], $email, $enabledEmail['id']);
                    }
                }
            }
            break;

        case ActivityCategory::Sleep->value:
            $start_time = new DateTime($enabledEmail['start_time']);
            $end_time = new DateTime($enabledEmail['end_time']);

            foreach ($users as $user) {
                require base_path("config/email_data.php");
                $wakeupTimeDifference = $now->diff($start_time);
                $bedTimeDifference = $now->diff($end_time);

                if ($start_time <= $now && $wakeupTimeDifference->i <= 0.5) {
                    sendEmail($user, $EMAIL['wakeup_time']['subject'], $EMAIL['wakeup_time']['body'], $email, $enabledEmail['id']);
                } elseif ($end_time <= $now && $bedTimeDifference->i <= 0.5) {
                    sendEmail($user, $EMAIL['sleep_time']['subject'], $EMAIL['sleep_time']['body'], $email, $enabledEmail['id']);
                }
            }
            break;

        case ActivityCategory::Water->value:
            $scheduleTimeStamps = generateTimeArray($enabledEmail['start_time'], $enabledEmail['end_time'], $enabledEmail['frequency']);
            foreach ($scheduleTimeStamps as $scheduleTimeStamp) {
                $scheduledTime = new DateTime($scheduleTimeStamp);
                $timeDifference = $now->diff($scheduledTime);

                foreach ($users as $user) {
                    require base_path("config/email_data.php");

                    if ($scheduledTime <= $now && $timeDifference->i <= 0.5) {
                        sendEmail($user, $EMAIL['water']['subject'], $EMAIL['water']['body'], $email, $enabledEmail['id']);
                    }
                }
            }
            break;
    }
}
