<?php

declare(strict_types=1);

use App\Enums\ActivityCategory;
use App\Enums\EmailStatus;
use App\Helper\Mail;
use App\Models\Email;

require_once __DIR__ . '/../vendor/autoload.php';
const BASE_PATH = __DIR__ . "/../";
require BASE_PATH . "config/bootstrap.php";

echo "corn is working\n";
$originalTimeZone = date_default_timezone_get();
date_default_timezone_set('Asia/Kathmandu');

$email = new Email();
$enabledEmails = $email->getAllEnabledEmailReminders();
foreach ($enabledEmails as $enabledEmail) {
    // If it is 00:00 rest pending to frequency to send emeail for next day
    if ((new DateTime())->format('H:i') === "00:00") {
        $email->updatePendingCount($enabledEmail['id'], $enabledEmail['frequency']);
        $email->updateFailedCount($enabledEmail['id'], 0);
        $email->updateSentCount($enabledEmail['id'], 0);
    } else {
        $pending_count = $enabledEmail['frequency'] - intval($enabledEmail['sent_count']) - intval($enabledEmail['failed_count']);
        $email->updatePendingCount($enabledEmail['id'], $pending_count);
    }

    if (intval($enabledEmail['activity_category']) === ActivityCategory::Exercise->value) {
        $users = $email->getRecipient($enabledEmail['user_id']);
        $scheduleTimeStamps = generateTimeArray($enabledEmail['start_time'], $enabledEmail['end_time'], $enabledEmail['frequency']);
        foreach ($scheduleTimeStamps as $key => $scheduleTimeStamp) {
            $now = new DateTime();
            $scheduledTime = new DateTime($scheduleTimeStamp);
            // d($scheduledTime);
            $timeDifference = $now->getTimestamp() - $scheduledTime->getTimestamp();
            foreach ($users as $user) {
                require base_path("config/email_data.php");
                $timeDifference = $now->diff($scheduledTime);
                if (($now->format('H')) === 01 && $timeDifference->h === 0 && $timeDifference->i === 0 && $timeDifference->s <= 59) {
                    $m = new Mail(
                        $user['email'],
                        $EMAIL['morning_exercise']['subject'],
                        $EMAIL['morning_exercise']['body']
                    );
                    $result = $m->send();
                    if ($result) {
                        $email->decreasePendingCount($enabledEmail['id']);
                        $email->increaseSentCount($enabledEmail['id']);
                    } else {
                        $email->increaseFailedCount($enabledEmail['id']);
                    }
                    // } elseif (($now->format('H')) < 18 && ($now->format('H')) > 11 && $scheduledTime <= $now && $timeDifference->i ===0) {
                } elseif (($now->format('H')) < 18 && ($now->format('H')) > 11 && $timeDifference->h === 0 && $timeDifference->i === 0 && $timeDifference->s <= 59) {
                    $m = new Mail(
                        $user['email'],
                        $EMAIL['exercise']['subject'],
                        $EMAIL['exercise']['body']
                    );
                    $result = $m->send();
                    if ($result) {
                        $email->decreasePendingCount($enabledEmail['id']);
                        $email->increaseSentCount($enabledEmail['id']);
                    } else {
                        $email->increaseFailedCount($enabledEmail['id']);
                    }
                    // } elseif (($now->format('H')) >= 18 && $scheduledTime <= $now && $timeDifference->i ===0) {
                } elseif (($now->format('H')) >= 18 && $timeDifference->h === 0 && $timeDifference->i === 0 && $timeDifference->s <= 59) {
                    $m = new Mail(
                        $user['email'],
                        $EMAIL['night_exercise']['subject'],
                        $EMAIL['night_exercise']['body']
                    );
                    $result = $m->send();
                    if ($result) {
                        $email->decreasePendingCount($enabledEmail['id']);
                        $email->increaseSentCount($enabledEmail['id']);
                    } else {
                        $email->increaseFailedCount($enabledEmail['id']);
                    }
                }
            }
        }
    }
    if (intval($enabledEmail['activity_category']) === ActivityCategory::Sleep->value) {
        $users = $email->getRecipient($enabledEmail['user_id']);
        // $scheduleTimeStamps = generateTimeArray($enabledEmail['start_time'], $enabledEmail['end_time'], $enabledEmail['frequency']);
        // foreach ($scheduleTimeStamps as $key => $scheduleTimeStamp) {
        $now = new DateTime();
        $start_time = new DateTime($enabledEmail['start_time']);
        $end_time = new DateTime($enabledEmail['end_time']);
        // d($scheduledTime);
        // $timeDifference = $now->getTimestamp() - $scheduledTime->getTimestamp();
        foreach ($users as $user) {
            require base_path("config/email_data.php");
            $wakeupTimeDifference = $now->diff($start_time);
            $bedTimeDifference = $now->diff($end_time);
            d($wakeupTimeDifference);
            d($bedTimeDifference);
            // if ($start_time <= $now && $wakeupTimeDifference->i ===0 && $wakeupTimeDifference->h === 0) {
            if ($wakeupTimeDifference->h === 0 && $wakeupTimeDifference->i === 0 && $wakeupTimeDifference->s <= 59) {
                $m = new Mail(
                    $user['email'],
                    $EMAIL['wakeup_time']['subject'],
                    $EMAIL['wakeup_time']['body']
                );
                $result = $m->send();
                if ($result) {
                    $email->decreasePendingCount($enabledEmail['id']);
                    $email->increaseSentCount($enabledEmail['id']);
                } else {
                    $email->increaseFailedCount($enabledEmail['id']);
                }
                // } elseif ($end_time <= $now && $bedTimeDifference->i ===0 && $bedTimeDifference->h === 0) {
            } elseif ($bedTimeDifference->h === 0 && $bedTimeDifference->i === 0 && $bedTimeDifference->s <= 59) {
                $m = new Mail(
                    $user['email'],
                    $EMAIL['sleep_time']['subject'],
                    $EMAIL['sleep_time']['body']
                );
                $result = $m->send();
                if ($result) {
                    $email->decreasePendingCount($enabledEmail['id']);
                    $email->increaseSentCount($enabledEmail['id']);
                } else {
                    $email->increaseFailedCount($enabledEmail['id']);
                }
            }
        }
    }
    if (intval($enabledEmail['activity_category']) === ActivityCategory::Water->value) {
        $users = $email->getRecipient($enabledEmail['user_id']);
        $scheduleTimeStamps = generateTimeArray($enabledEmail['start_time'], $enabledEmail['end_time'], $enabledEmail['frequency']);
        foreach ($scheduleTimeStamps as $key => $scheduleTimeStamp) {
            $now = new DateTime();
            $scheduledTime = new DateTime($scheduleTimeStamp);
            // d($scheduledTime);
            $timeDifference = $now->getTimestamp() - $scheduledTime->getTimestamp();
            foreach ($users as $user) {
                require base_path("config/email_data.php");
                $timeDifference = $now->diff($scheduledTime);
                if ($scheduledTime <= $now && $timeDifference->i === 0) {
                    $m = new Mail(
                        $user['email'],
                        $EMAIL['water']['subject'],
                        $EMAIL['water']['body']
                    );
                    $result = $m->send();
                    if ($result) {
                        $email->decreasePendingCount($enabledEmail['id']);
                        $email->increaseSentCount($enabledEmail['id']);
                    } else {
                        $email->increaseFailedCount($enabledEmail['id']);
                    }
                }
            }
        }
    }
}


date_default_timezone_set($originalTimeZone);
