<h1>Отправить сообщение</h1>
<p id="error"><#errormessage#></p>
<form method="post" action="?page=send" name="registerform" id="registerform">  
    <fieldset>  
        <label for="username">Пользователь:</label><input type="text" name="username" id="username" value="<#username#>"><br>  
        <label for="title">Тема:</label><input type="text" name="title" id="title"><br>  
        <label for="message">Сообщение:</label><textarea cols="40" rows="5" name="message" id="message"></textarea><br>  
        <input type="submit" name="send" id="send" value="Отправить">  
    </fieldset>  
</form> 
