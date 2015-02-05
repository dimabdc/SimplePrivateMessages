<?php
if (!defined("IN_ANNOUNCE")) {
    die("Hacking attempt!");
}

$mysql_host = 'localhost';
$mysql_user = 'dbuser';
$mysql_pass = 'dbpass';
$mysql_db = 'dbuser';
$mysql_charset = 'utf8';

$lang = "ru";

$db = new mysqldb($mysql_host, $mysql_user, $mysql_pass, $mysql_db, $mysql_charset);
