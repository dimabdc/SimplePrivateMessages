<?php 
if (! defined ( "IN_ANNOUNCE" ))
	die ( "Hacking attempt!" );

if ($islogin) {
    header("Location: ?page=private");
    exit;
} elseif (isset($_POST['register'])) {
    if (!$_POST['username']) {
        $errormessage = "Логин не может быть пустым! ";
    } elseif (!$_POST['password']) {
        $errormessage = "Пароль не может быть пустым! ";
    } elseif (!$_POST['email']) {
        $errormessage = "E-mail не может быть пустым! ";
    } else {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	
	if ($_POST['password'] == $username) {
            $errormessage = "Пароль не может быть такой-же как имя пользователя. ";
        } elseif (!validemail($email)) {
            $errormessage = "Неправельный E-mail адрес. ";
        } elseif (!validusername($username)) {
            $errormessage = "В логине недопустимые символы. ";
        } else {

            $result = $db->query("SELECT email FROM users WHERE (email='$email')");
            if ($db->num_rows($result) > 0) {
                $errormessage = "E-mail адрес $email уже зарегистрирован в системе.";
            } else {

                $result = $db->query("SELECT username FROM users WHERE (username='$username')");
                if ($db->num_rows($result) > 0) {
                    $errormessage = "$username уже зарегистрирован в системе.";
                } else {
                    $secret = generateCode();
                    $passhash = md5($secret . $_POST['password'] . $secret);
                    $last_login = time();
                    $query = "INSERT INTO users (username, passhash, secret, email, last_login) VALUES ('$username', '$passhash', '$secret', '$email', $last_login)";
                    $db->query($query);
                    $_SESSION['username'] = $username;
                    $_SESSION['userid'] = $db->result($db->query("SELECT id FROM users WHERE (username='$username')"), 0);
                    header("Location: ?page=private");
                    exit;
                }
            }
        }
    }
}
