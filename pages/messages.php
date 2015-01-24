<?php 
if (!defined("IN_ANNOUNCE")) {
    die("Hacking attempt!");
}

if (!$islogin) {
    header("Location: ?page=login");
}

$messages = "";
$unreadmessages = 0;
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$query = $db->query("SELECT messages.id, messages.repecient, messages.title, messages.date, messages.read, users.username FROM messages, users WHERE (messages.repecient='$userid' AND users.id=messages.sender) ORDER BY messages.id DESC");

while ($row = $db->fetch_array($query)) {
    $messages .= "<tr>";
    if ($row["read"] == 0) {
        $unreadmessages++;
        $messages .= "<td class='left'><a href=\"?page=message&id=".$row['id']."\"><b>".$row['title']."</b></a></td>";
    } else {
        $messages .= "<td class='left'><a href=\"?page=message&id=".$row['id']."\">".$row['title']."</a></td>";
    }
    $messages .= "<td>".$row['username']."</td>";
    $messages .= "<td>".date('d.m.Y H:i' ,$row['date'])."</td>";
    $messages .= "</tr>";
}
if ($db->num_rows($query) == 0) {
    $messages .= "<tr><td colspan='3' class='center'>У Вас нет сообщений.</td></tr>";
}
$htmltemplate->assign("countmessages", $db->num_rows($query));
$htmltemplate->assign("countunreadmessages", $unreadmessages);
$htmltemplate->assign("messages", $messages);
