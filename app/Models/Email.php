<?php

namespace App\Models;

use App\Enums\ActivityCategory;
use Database\Database;
use PDO;

class Email
{
    public function queue(
        int $userId,
        ActivityCategory $activityCategory,
        string $startTime,
        string $endTime,
        int $frequency,
    ) {
        // $query = "INSERT INTO email_reminder (user_id, activity_category, is_enabled, start_time, end_time, frequency)
        // VALUES (:user_id, :activity_category, :is_enabled, :start_time, :end_time, :frequency)";

        $query = "INSERT INTO email_reminder (user_id, activity_category, is_enabled, start_time, end_time, frequency)
               VALUES (:user_id, :activity_category, true , :start_time, :end_time, :frequency)
               ON CONFLICT (user_id, activity_category)
               DO UPDATE SET is_enabled = true;";

        $params = [
            'user_id' => [$userId, PDO::PARAM_INT],
            'activity_category' => [$activityCategory->value, PDO::PARAM_INT],
            'start_time' => [$startTime, PDO::PARAM_STR],
            'end_time' => [$endTime, PDO::PARAM_STR],
            'frequency' => [$frequency, PDO::PARAM_INT],
        ];

        return Database::insert($query, $params);
    }

    public function updateSentCount(int $id, int $sent_count)
    {
        $query = "UPDATE email_reminder
             SET sent_count = :sent_count
             WHERE id = :id";
        $params = [
            'id' => [$id, PDO::PARAM_INT],
            'sent_count' => [$sent_count, PDO::PARAM_INT],
        ];
        return Database::update($query, $params);
    }
    public function increaseSentCount(int $id, int $amount = 1)
    {
        $query = "UPDATE email_reminder
              SET sent_count = sent_count + :amount
              WHERE id = :id";

        $params = [
            'id' => [$id, PDO::PARAM_INT],
            'amount' => [$amount, PDO::PARAM_INT],
        ];

        return Database::update($query, $params);
    }

    public function updatePendingCount(int $id, int $pending_count)
    {
        $query = "UPDATE email_reminder
             SET pending_count = :pending_count
             WHERE id = :id";
        $params = [
            'id' => [$id, PDO::PARAM_INT],
            'pending_count' => [$pending_count, PDO::PARAM_INT],
        ];
        return Database::update($query, $params);
    }

    public function decreasePendingCount(int $id, int $amount = 1)
    {
        $query = "UPDATE email_reminder
              SET pending_count = pending_count - :amount
              WHERE id = :id";

        $params = [
            'id' => [$id, PDO::PARAM_INT],
            'amount' => [$amount, PDO::PARAM_INT],
        ];

        return Database::update($query, $params);
    }

    public function updateFailedCount(int $id, int $failed_count)
    {
        $query = "UPDATE email_reminder
             SET failed_count = :failed_count
             WHERE id = :id";
        $params = [
            'id' => [$id, PDO::PARAM_INT],
            'failed_count' => [$failed_count, PDO::PARAM_INT],
        ];
        return Database::update($query, $params);
    }

    public function increaseFailedCount(int $id, int $amount = 1)
    {
        $query = "UPDATE email_reminder
              SET failed_count = failed_count + :amount
              WHERE id = :id";

        $params = [
            'id' => [$id, PDO::PARAM_INT],
            'amount' => [$amount, PDO::PARAM_INT],
        ];

        return Database::update($query, $params);
    }

    public function disableEmailReminder(int $userId, ActivityCategory $activityCategory)
    {
        $query = "UPDATE email_reminder
              SET is_enabled = false
              WHERE user_id = :user_id AND activity_category = :activity_category";

        $params = [
            'user_id' => [$userId, PDO::PARAM_INT],
            'activity_category' => [$activityCategory->value, PDO::PARAM_INT],
        ];

        return Database::update($query, $params);
    }

    public function getAllEnabledEmailReminders()
    {
        $query = "SELECT * FROM email_reminder WHERE is_enabled = :is_enabled";
        $params = [
            'is_enabled' => [true, PDO::PARAM_BOOL]
        ];
        return Database::select($query, $params)->fetchAll();
    }

    public function getRecipient(int $userId)
    {
        $query = "SELECT email, first_name FROM users WHERE user_id = :user_id";
        $params = [
            'user_id' => [$userId, PDO::PARAM_INT],
        ];

        return Database::select($query, $params)->fetchAll();
    }
}
