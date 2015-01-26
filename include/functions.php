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

class HtmlTemplate {
    private $html;
    private $parameters = array();

    function assign($variable, $value) {
        $this->parameters[$variable] = $value;
    }

    function parse($template) { 
        $this->html = $template; 

        foreach (array_reverse ($this->parameters) as $key => $value) {
            $template_name = '<#' . $key . '#>';
            $this->html = str_replace($template_name, $value, $this->html);
        }
        return $this->html;
    }
    
    function display($template, $localize) {
        echo $localize->Translate($this->parse($template));
    }
}
