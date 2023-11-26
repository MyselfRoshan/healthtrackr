<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\EmailStatus;
use Database\Database;
use PDO;

class Email
{
    public function queue(
        string $to,
        string $from,
        string $subject,
        string $html,
        ?string $text = null
    ): void {
        $meta=[
            'to'=>$to,
            'from'=>$from
        ];

        $query = "INSERT INTO public.email (subject, status, html_body, text_body, meta, created_at)
        VALUES (:subject, :status, :html_body, :text_body, :meta , CURRENT_TIMESTAMP)";

        $params = [
            'subject' => [$subject, PDO::PARAM_STR],
            'status' => [EmailStatus::Queue->value, PDO::PARAM_STR],
            'html_body' => [$html, PDO::PARAM_STR],
            'text_body' => [$text, PDO::PARAM_STR],
            'meta' => [json_encode($meta), PDO::PARAM_STR],
        ];

        return Database::insert($query,$params);
    }

    public function getEmailsByStatus(EmailStatus $status): array
    {
        $query = "SELECT * FROM public.email WHERE status = :status";
        $params = [
            'status' => [EmailStatus::Queue->value, PDO::PARAM_STR],
        ];
        return Database::select($query,$params)->fetchAll();
    }

    public function markEmailSent(int $id): void
    {
        $query = "UPDATE public.email
             SET status = :status, sent_at = CURRENT_TIMESTAMP
             WHERE id = :id";
        $params = [
            'status' => [EmailStatus::Queue->value, PDO::PARAM_STR],
        ];
        return Database::update($query,$params);
    }

    public function updateEmailStatus(int $id, EmailStatus $status): void
    {
        $query = "UPDATE public.email
            SET status = :status
            WHERE id = :id";

        $params = [
            'status' => [$status->value, PDO::PARAM_INT],
            'id' => [$id, PDO::PARAM_INT],
        ];

        Database::update($query, $params);
    }
}
