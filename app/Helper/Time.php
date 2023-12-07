<?php

namespace App\Helper;

use DateTime;

class Time
{
    public static function to24Hrs($time12hr)
    {
        return date("H:i", strtotime($time12hr));
    }

    public static function to12Hrs($time24hr)
    {
        return date("h:i A", strtotime($time24hr));
    }

    public static function ago($dateString)
    {
        if (!isset($dateString)) return '-';
        $date = new DateTime($dateString);
        $now = new DateTime();
        $diff = $now->diff($date);

        if ($diff->y > 0) {
            return $date->format('M j, Y');
        } elseif ($diff->m > 0) {
            return $date->format('M j');
        } elseif ($diff->d > 0) {
            return $diff->d == 1 ? 'yesterday' : $diff->d . ' days ago';
        } elseif ($diff->h > 0) {
            return $diff->h == 1 ? 'an hour ago' : $diff->h . ' hours ago';
        } elseif ($diff->i > 0) {
            return $diff->i == 1 ? 'a minute ago' : $diff->i . ' minutes ago';
        } else {
            return 'just now';
        }
    }
}
