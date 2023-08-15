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

// function login($user)
// {
//     // $_SESSION['user'] = [
//     //     'username' => $user['username'],
//     //     'email' => $user['email']
//     // ];
//     // session_regenerate_id(true);
//     // session_regenerate_id(true);
//     $session = Session::getInstance();
//     $session->user = [
//         'username' => $user['username'],
//         'email' => $user['email']
//     ];
// }

function redirect($path)
{
    header("location: {$path}");
    exit();
}
