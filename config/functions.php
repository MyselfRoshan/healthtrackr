<?php

function dd($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    die();
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
