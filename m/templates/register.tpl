<!DOCTYPE html>
<html>
    <head>
        <title>Public - Register</title>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.css" />
        <link rel="stylesheet" href="css/screen.css" />
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.3.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.js"></script>
    </head>
    <body>

        <div data-role="page">

            <div data-role="header">
                <h1>pub<span id="lic">lic</span></h1>
            </div><!-- /header -->

            <div data-role="content">
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
            </div><!-- /content -->

            <div data-role="footer">
                <h4>&#169 pub<span id="lic">lic</span></h4>
            </div><!-- /header -->
        </div><!-- /page -->

    </body>
</html>