<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>

        <title>Public - a social drinking application</title>

        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

        <link rel="stylesheet" type="text/css" media="screen" href="/css/reset.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="/css/screen.css" />
    </head>
    <body>

        <div id="header" class="fluid">
      <div class="container">
        <h1><a class="imgreplacement" href="/">Public</a></h1>
        <ul id="navigation">
          <li {option:oNavHome}class="active"{/option:oNavHome}><a href="/">Home</a></li>
          <li {option:oNavPubs}class="active"{/option:oNavPubs}><a href="/pubs">Pubs</a></li>
        </ul>

        <div id="fb-root"></div>
        <script type="text/javascript">
          window.fbAsyncInit = function() {
            FB.init({
              appId   : {$appid},
              session : {$session}, // don't refetch the session when PHP already has it
              status  : true, // check login status
              cookie  : true, // enable cookies to allow the server to access the session
              xfbml   : true // parse XFBML
            });

            // whenever the user logs in, we refresh the page
            FB.Event.subscribe('auth.login', function() {
              window.location="fblogin.php";
            });

          };

          function facebookLogin() {
              FB.getLoginStatus(function(response) {
                if (response.session) {
                  //$('#fb_login_form').submit();
                  window.location="fblogin.php";
                } else {
                 FB.login(function(response) {
                    if (response.session && response.perms) {
                      //$('#fb_login_form').submit();
                        window.location="fblogin.php";
                    } else { }
                  });
                }
              });
            }


          (function() {
            var e = document.createElement('script');
            e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
            e.async = true;
            document.getElementById('fb-root').appendChild(e);
          }());
        </script>

        <ul id="login">
          <li class="first"><a href="login.php">Login</a></li>
          <li><a href="register.php">Signup</a></li>
          <li><a href="#" class="imgreplacement" onclick="facebookLogin(); return false;">Login with Facebook</a></li>
        </ul>
      </div>
    </div>
        
        {$content}
        
        <div id="footer" class="fluid">
            <div class="container">
                <p>&copy; public &mdash; created by <a href="http://www.twitter.com/mmmphs">@mmmphs</a>, <a href="http://www.twitter.com/Jonckheere_M">@jonckheere_M</a>, <a href="http://www.twitter.com/joenmaes">@joenmaes</a> and a huge amount of alcohol</p>
            </div>
        </div>

    </body>
</html>