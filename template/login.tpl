<h1><$aut$></h1>  
<p><$aut_in$><a href="?page=register"><$aut_reg$></a>.</p>  
<p id="error"><#errormessage#></p>
<form method="post" action="index.php?page=login" name="loginform" id="loginform">  
    <fieldset>  
        <input type="hidden" value="login" name="operation">
        <label for="username"><$login$>:</label><input type="text" name="username" id="username"><br>  
        <label for="password"><$password$>:</label><input type="password" name="password" id="password"><br>  
        <input type="submit" name="login" id="login" value="<$aut_aut$>">  
    </fieldset>  
</form>
