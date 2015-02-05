<?php
if (!defined("IN_ANNOUNCE")) {
    die("Hacking attempt!");
}

function generateCode($length=20) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;  
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];  
    }
    return $code;
} 

function validusername($username) {
    if ($username == "") {
        return false;
    }

    $allowedchars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_" .
            "абвгдеёжзиклмнопрстуфхшщэюяьъАБВГДЕЁЖЗИКЛМНОПРСТУФХШЩЭЮЯЬЪ";

    for ($i = 0; $i < strlen($username); ++$i) {
        if (strpos($allowedchars, $username[$i]) === false) {
            return false;
        }
    }

    return true;
}

function validemail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL))
        return true;
    return false;
}

function require_once_wildcard($wildcard) {
    foreach (glob($wildcard) as $filename) {
        include_once $filename;
    }
}
