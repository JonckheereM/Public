<!DOCTYPE html> 
<html> 
    <head>
        <title>Public - Log in</title>
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
            </div><!-- /content -->

            <div data-role="footer">
                <h4>&#169; pub<span id="lic">lic</span></h4>
            </div><!-- /header -->
        </div><!-- /page -->

    </body>
</html>
