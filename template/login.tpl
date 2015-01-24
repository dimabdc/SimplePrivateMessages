<h1>Авторизация</h1>  
<p>Войдите или <a href="?page=register">зарегистрируйтесь</a>.</p>  
<p id="error"><#errormessage#></p>
<form method="post" action="index.php?page=login" name="loginform" id="loginform">  
    <fieldset>  
        <input type="hidden" value="login" name="operation">
        <label for="username">Логин:</label><input type="text" name="username" id="username"><br>  
        <label for="password">Пароль:</label><input type="password" name="password" id="password"><br>  
        <input type="submit" name="login" id="login" value="Войти">  
    </fieldset>  
</form>
