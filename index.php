<?php 
session_start() or die("Error initializing session.");

$template_page = array();
$errormessage = "";
$islogin = isset($_SESSION['username'])?true:false;

define ('IN_ANNOUNCE', true);
define("ROOT_PATH",dirname(__FILE__).'/');
require_once(ROOT_PATH . 'include/config.php');
require_once(ROOT_PATH . 'include/functions.php');

$htmltemplate = new HtmlTemplate();

$page = isset($_GET['page'])?$_GET['page']:"login";
if (is_file ("pages/".$page.".php")){
    require_once "pages/".$page.".php";
}

if (is_file ("template/$page.tpl")){
    $template_page = file("template/$page.tpl");
}
$template_page = implode("", $template_page);

$template_main = file("template/main.tpl");
$template_main = implode("", $template_main);

$htmltemplate->assign("pagetitle", $page);
$htmltemplate->assign("errormessage", $errormessage);
$htmltemplate->assign("main", $template_page);

header('Content-type: text/html; charset=utf-8');
$htmltemplate->display($template_main);
