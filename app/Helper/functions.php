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
