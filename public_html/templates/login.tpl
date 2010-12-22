<script src="https://www.google.com/jsapi?key=ABQIAAAAjClSPIOxNBGxBX4-wq0z2RR75ioQX0VOMPX_acNpIAmoM0SKwBTs1bZPV2MDQ-Ye-OpLfVC0J89Isw" type="text/javascript"></script>
<script type="text/javascript">
  google.load("jquery", "1");
  google.load("jqueryui", "1");
</script>

<script>
  $(function() {
    $("input:submit").button();
  });
</script>

<link rel="stylesheet" media="screen" href="css/register.css"/>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/themes/base/jquery-ui.css" type="text/css" media="all" />
<div id="content">
  <div id="registerFormHolder">

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
    <div id="FBC">
      <a href="#" onclick="facebookLogin(); return false;"><img src="img/fb-login-button.png"></a>
    </div>
    <fieldset>
      <legend>Login</legend>
      <form id="loginForm" action="login.php" method="post">
        <p>
          <label for="email">Email</label>
          <input type="text" name="email" id="email"/>
        </p>
        <p>
          <label for="password">Password</label>
          <input type="password" name="password" id="password"/>
        </p>
        <p>
          <input type="submit" value="Log in" id="loginButton"/>
        </p>
      </form>
    </fieldset>

  </div>
</div>