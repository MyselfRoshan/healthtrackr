<?php

function dd($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    die();
}

function d($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function require_view($path, $attributes = [])
{
    extract($attributes);
    require base_path("views/{$path}");
}

function require_svg($path, $attributes = [])
{
    extract($attributes);
    require "resources/svg/{$path}";
}

function redirect(string $path, int|null $afterInSeconds = null)
{
    if ($afterInSeconds)
        header("Refresh: {$afterInSeconds}; URL={$path}");
    else {
        header("Location: {$path}");
        exit();
    }
}

function generateRandomToken($length = 32)
{
    return bin2hex(random_bytes($length));
}

function timeago($date)
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

function getUserDate($UTCdate, $timeZone)
{
    $d = new DateTime();
    $d->setTimestamp(strtotime($UTCdate));
    $d->setTimezone(new DateTimeZone($timeZone));
    return $d;
}

function delete_IMG($file_path): void
{
    if (file_exists($file_path)) {
        unlink($file_path);
    } else {
        // File not found.
    }
}

// function generateTimeArray(string $start_time, string $end_time, int $repeat)
// {
//     $start_timestamp = strtotime($start_time);
//     $end_timestamp = strtotime($end_time);

//     if ($start_timestamp === false || $end_timestamp === false || $repeat <= 0) {
//         // Invalid start or end time, or invalid repeat count
//         return [];
//     }

//     $time_difference = $end_timestamp - $start_timestamp;

//     if ($time_difference <= 0) {
//         // Invalid time difference
//         return [];
//     }

//     $interval = round($time_difference / max(1, $repeat)); // Ensure repeat is at least 1
//     $time_array = [];

//     for ($i = 0; $i < $repeat; $i++) {
//         $current_time = $start_timestamp + ($interval * $i);
//         $formatted_time = date('H:i:s', $current_time);
//         $time_array[] = $formatted_time;
//     }

//     return $time_array;
// }

function generateTimeArray(string $start_time, string $end_time, int $repeat)
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

function toFeetInches($decimalHeight)
{
    // Extract feet and inches
    if (isset($height)) {
        $height = explode(".", $decimalHeight);

        // Build the string representation
        $result = $height[0] . "'";
        $result .= $height[1] . "\"";
        return $result;
    }
    return null;
}
