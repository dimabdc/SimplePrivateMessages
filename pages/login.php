<?php 
if (! defined ( "IN_ANNOUNCE" ))
	die ( "Hacking attempt!" );

if ($islogin) {
    header("Location: ?page=private");
} elseif (isset($_POST['login'])) {
    if (!$_POST['username']) {
        $errormessage = "Логин не может быть пустым! ";
    } elseif (!$_POST['password']) {
        $errormessage = "Пароль не может быть пустым! ";
    } else {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);

        $result = $db->fetch_array($db->query("SELECT passhash, secret, id FROM users WHERE (username = '$username')"));
        if ($result["passhash"] != md5($result["secret"] . $_POST['password'] . $result["secret"]) || !$result) {
            $errormessage = "Имя пользователя или пароль указаны не верно.";
        } else {
            $last_login = time();
            $userid = $result['id'];
            mysql_query("UPDATE users SET last_login = $last_login WHERE id = $userid");
            $_SESSION['username'] = $username;
            $_SESSION['userid'] = $userid;
            header("Location: ?page=private");
        }
    }
}
