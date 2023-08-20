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
