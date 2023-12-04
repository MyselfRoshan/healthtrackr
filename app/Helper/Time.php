<?php

namespace App\Helper;

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

    public static function ago($date)
    {
        if (!isset($date)) return '-';
        else {
            $timestamp = strtotime($date);

            $strTime = array("second", "minute", "hour", "day", "month", "year");
            $length = array("60", "60", "24", "30", "12", "10");

            $currentTime = time();
            if ($currentTime >= $timestamp) {
                $diff = time() - $timestamp;
                for ($i = 0; $diff >= $length[$i] && $i < count($length) - 1; $i++) {
                    $diff = $diff / $length[$i];
                }

                $diff = round($diff);

                // Check if pluralization is needed
                if ($diff > 1) {
                    return $diff . " " . $strTime[$i] . "s ago";
                } else {
                    return $diff . " " . $strTime[$i] . " ago";
                }
            }
        }
    }
}
