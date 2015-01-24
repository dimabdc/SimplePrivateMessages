<?php 
if (!defined("IN_ANNOUNCE")) {
    die("Hacking attempt!");
}

if (!$islogin) {
    header("Location: ?page=login");
}

if (isset($_GET["id"])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $userid = $_SESSION['userid'];
    $username = $_SESSION['username'];
    $query = $db->query("SELECT messages.repecient, messages.title, messages.message, messages.date, messages.read, users.username FROM messages, users WHERE (messages.repecient='$userid' AND messages.id='$id' AND users.id=messages.sender)");
    $result = $db->fetch_array($query);
    if ($db->num_rows($query) > 0) {
        $htmltemplate->assign("messagetitle", $result["title"]);
        $htmltemplate->assign("datemessage", date('d.m.Y H:i' ,$result["date"]));
        $htmltemplate->assign("username", $result["username"]);
        $htmltemplate->assign("message", $result["message"]);
    } else {
        header("Location: ?page=login");
    }
} else {
    header("Location: ?page=login");
}
