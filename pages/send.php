<?php 
if (!defined("IN_ANNOUNCE")) {
    die("Hacking attempt!");
}

if (!$islogin) {
    header("Location: ?page=login");
    exit;
} elseif (isset($_POST['send'])) {
    if (!$_POST['username']) {
        $errormessage = $localize->Translate('error_empty_username');
    } else {
        $repecient = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
        $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);
        $username = $_SESSION['userid'];
	
	if (!validusername($username)) {
            $errormessage = $localize->Translate('error_invalid_username');
        } else {
            $query = $db->query("SELECT id FROM users WHERE (username='$repecient')");
            if ($db->num_rows($query) == 0) {
                $errormessage = $repecient . $localize->Translate('error_unregistered_username');
            } else {
                $repecient = $db->result($query);
                $date = time();
                $query = "INSERT INTO messages (sender, repecient, title, message, date) VALUES ('$username', '$repecient', '$title', '$message', $date)";
                $db->query($query);
                header("Location: ?page=messages");
                exit;
            }
        }
    }
}
$htmltemplate->assign("username", isset($_GET['user'])?$_GET['user']:"");
