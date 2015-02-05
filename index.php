<?php 
session_start() or die("Error initializing session.");

$template_page = array();
$errormessage = "";
$islogin = isset($_SESSION['username'])?true:false;

define ('IN_ANNOUNCE', true);
define("ROOT_PATH",dirname(__FILE__).'/');

require_once ROOT_PATH . 'include/functions.php';
spl_autoload_register(function ($class) {
    include ROOT_PATH . 'include/classes/' . $class . '.class.php';
});
require_once ROOT_PATH . 'include/config.php';

$htmltemplate = new HtmlTemplate();

$localize = Localizer::getInstance();
$localize->setLanguage($lang);

$page = isset($_GET['page'])?$_GET['page']:"login";
if (is_file (ROOT_PATH . "pages/".$page.".php")){
    require_once ROOT_PATH . "pages/".$page.".php";
}

if (is_file (ROOT_PATH . "template/$page.tpl")){
    $template_page = file(ROOT_PATH . "template/$page.tpl");
}
$template_page = implode("", $template_page);

$template_main = implode("", file(ROOT_PATH . "template/main.tpl"));

$htmltemplate->assign("pagetitle", $page);
$htmltemplate->assign("errormessage", $errormessage);
$htmltemplate->assign("main", $template_page);

header('Content-type: text/html; charset=utf-8');
$htmltemplate->display($template_main, $localize);
