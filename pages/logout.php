<?php 
if (!defined("IN_ANNOUNCE")) {
    die("Hacking attempt!");
}

if ($islogin) {
    $_SESSION = array();
    session_destroy(); 
}
header("Location: ?page=login");