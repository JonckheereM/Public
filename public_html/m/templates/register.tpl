<form action="{$formaction}" method="post">
    <div data-role="fieldcontain">
        <label for="name">First name:</label>
        <input type="text" name="first_name" id="first_name" value="{$first_name|htmlentities}"  />
        <span class="error" id="msgFirst_name">{$msgFirst_name|htmlentities}</span>
    </div>
    <div data-role="fieldcontain">
        <label for="name">Last name:</label>
        <input type="text" name="last_name" id="last_name" value="{$last_name|htmlentities}"  />
        <span class="error" id="msgLast_name">{$msgLast_name|htmlentities}</span>
    </div>
    <div data-role="fieldcontain">
        <label for="name">Username:</label>
        <input type="text" name="username" id="username" value="{$username|htmlentities}"  />
        <span class="error" id="msgUsername">{$msgUsername|htmlentities}</span>
    </div>
    <div data-role="fieldcontain">
        <label for="name">Email:</label>
        <input type="text" name="mail" id="mail" value="{$mail|htmlentities}"  />
        <span class="error" id="msgMail">{$msgMail|htmlentities}</span>
    </div>
    <div data-role="fieldcontain">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" value="{$password|htmlentities}" />
        <span class="error" id="msgPassword">{$msgPassword|htmlentities}</span>
    </div>
    <input type="submit" data-theme="b" id="btnSignup" name="btnSignup" value="Sign up"/>
</form>
