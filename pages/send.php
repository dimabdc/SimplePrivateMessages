<?php 
if (!defined("IN_ANNOUNCE")) {
    die("Hacking attempt!");
}

if (!$islogin) {
    header("Location: ?page=login");
    exit;
} elseif (isset($_POST['send'])) {
    if (!$_POST['username']) {
        $errormessage = "Введите пользователя! ";
    } else {
        $repecient = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
        $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);
        $username = $_SESSION['userid'];
	
	if (!validusername($username)) {
            $errormessage = "В имени пользователя недопустимые символы. ";
        } else {
            $query = $db->query("SELECT id FROM users WHERE (username='$repecient')");
            if ($db->num_rows($query) == 0) {
                $errormessage = "$username не зарегистрирован в системе.";
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
