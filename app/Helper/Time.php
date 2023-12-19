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

    public static function generateIntervals(string $start_time, string $end_time, int $repeat)
    {
        $start_timestamp = strtotime($start_time);
        $end_timestamp = strtotime($end_time);

        if ($start_timestamp === false || $end_timestamp === false || $repeat <= 0) {
            // Invalid start or end time, or invalid repeat count
            return [];
        }

        $time_difference = $end_timestamp - $start_timestamp;

        if ($time_difference <= 0) {
            // Invalid time difference
            return [];
        }


        $interval = round($time_difference / max(1, $repeat - 1)); // Adjusted to ensure equal differences
        $time_array = [];

        for ($i = 0; $i < $repeat; $i++) {
            $current_time = $start_timestamp + ($interval * $i);
            $formatted_time = date('H:i:s', $current_time);
            $time_array[] = $formatted_time;
        }

        return $time_array;
    }

    public static function countFutureIntervals(array $timeArray)
    {
        $currentTimestamp = time();
        $futureCount = 0;

        foreach ($timeArray as $formattedTime) {
            $intervalTimestamp = strtotime($formattedTime);

            if ($intervalTimestamp > $currentTimestamp) {
                $futureCount++;
            }
        }

        return $futureCount;
    }
}
