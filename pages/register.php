<?php 
if (! defined ( "IN_ANNOUNCE" ))
	die ( "Hacking attempt!" );

if ($islogin) {
    header("Location: ?page=private");
    exit;
} elseif (isset($_POST['register'])) {
    if (!$_POST['username']) {
        $errormessage = $localize->Translate('error_empty_login');
    } elseif (!$_POST['password']) {
        $errormessage = $localize->Translate('error_empty_password');
    } elseif (!$_POST['email']) {
        $errormessage = $localize->Translate('error_empty_email');
    } else {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	
	if ($_POST['password'] == $username) {
            $errormessage = $localize->Translate('error_invalid_passwor');
        } elseif (!validemail($email)) {
            $errormessage = $localize->Translate('error_invalid_email');
        } elseif (!validusername($username)) {
            $errormessage = $localize->Translate('error_invalid_login');
        } else {

            $result = $db->query("SELECT email FROM users WHERE (email='$email')");
            if ($db->num_rows($result) > 0) {
                $errormessage = $localize->Translate('error_registered_email') . $email . $localize->Translate('error_registered');
            } else {

                $result = $db->query("SELECT username FROM users WHERE (username='$username')");
                if ($db->num_rows($result) > 0) {
                    $errormessage = $username . $localize->Translate('error_registered');
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
