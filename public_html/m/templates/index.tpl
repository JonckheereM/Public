<form method="post">
    <div data-role="fieldcontain">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="{$username|htmlentities}"  />
    </div>
    <div data-role="fieldcontain">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" value="{$password|htmlentities}" />
        <span class="error" id="msgFault">{$msgFault|htmlentities}</span>
    </div>
    <input type="submit" data-theme="b" id="btnSignin" name="btnSignin" value="Sign in"/>
</form>
<p>
    New here? <a href="register.php">Join Public!</a>
</p>