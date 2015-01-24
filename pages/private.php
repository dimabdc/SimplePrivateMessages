<?php 
if (! defined ( "IN_ANNOUNCE" ))
	die ( "Hacking attempt!" );

if (!$islogin) {
    header("Location: ?page=login");
}

$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$email = $db->result($db->query("SELECT email FROM users WHERE (id='$userid')"), 0);
$htmltemplate->assign("email", $email);
$htmltemplate->assign("username", $username);
