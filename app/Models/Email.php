<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\EmailStatus;
use Database\Database;
use PDO;

class Email
{
    /** TO DO
     *  Get timezone from database instead of hard coding to 'Asia/Kathmandu'
     */
    public function queue(
        string $recipent,
        string $subject,
        string $html,
        ?string $scheduled_at = null,
        ?string $text = null,
    ) {
        $query = "INSERT INTO public.email (recipent, subject, status, html_body, text_body, created_at, scheduled_at)
        VALUES (:recipent, :subject, :status, :html_body, :text_body, CURRENT_TIMESTAMP AT TIME ZONE 'Asia/Kathmandu', :scheduled_at)";
        // VALUES (:recipent, :subject, :status, :html_body, :text_body, CURRENT_TIMESTAMP AT TIME ZONE '{$_COOKIE['timeZone']}', :scheduled_at)";

        $params = [
            'recipent' => [$recipent, PDO::PARAM_STR],
            'subject' => [$subject, PDO::PARAM_STR],
            'status' => [EmailStatus::Queue->value, PDO::PARAM_STR],
            'html_body' => [$html, PDO::PARAM_STR],
            'scheduled_at' => [$scheduled_at, PDO::PARAM_STR],
            'text_body' => [$text, PDO::PARAM_STR],
        ];

        return Database::insert($query, $params);
    }

    public function getEmailsByStatus(EmailStatus $status): array
    {
        $query = "SELECT * FROM public.email WHERE status = :status";
        $params = [
            'status' => [EmailStatus::Queue->value, PDO::PARAM_STR],
        ];
        return Database::select($query, $params)->fetchAll();
    }

    public function markEmailSent(int $id)
    {
        $query = "UPDATE public.email
             SET status = :status, sent_at = CURRENT_TIMESTAMP AT TIME ZONE 'Asia/Kathmandu'
             WHERE id = :id";
        $params = [
            'status' => [EmailStatus::Sent->value, PDO::PARAM_STR],
            'id' => [$id, PDO::PARAM_INT],
        ];
        return Database::update($query, $params);
    }

    public function updateEmailStatus(int $id, EmailStatus $status)
    {
        $query = "UPDATE public.email
            SET status = :status, sent_at = CURRENT_TIMESTAMP AT TIME ZONE 'Asia/Kathmandu'
            WHERE id = :id";

        $params = [
            'status' => [$status->value, PDO::PARAM_INT],
            'id' => [$id, PDO::PARAM_INT],
        ];

        return Database::update($query, $params);
    }
}
