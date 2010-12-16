<script src="https://www.google.com/jsapi?key=ABQIAAAAjClSPIOxNBGxBX4-wq0z2RR75ioQX0VOMPX_acNpIAmoM0SKwBTs1bZPV2MDQ-Ye-OpLfVC0J89Isw" type="text/javascript"></script>
<script type="text/javascript">
    google.load("jquery", "1");
    google.load("jqueryui", "1");
</script>

<script type="text/javascript" src="js/jquery.password_strength.js"></script>

<script>
$(function() {
    $("input:submit").button();

    $('input[type=password]').password_strength();
});
</script>

<script type="text/javascript" src="js/register.js"></script>
<link rel="stylesheet" media="screen" href="css/register.css"/>
<link rel="stylesheet" media="screen" href="css/passwordstrength.css"/>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/themes/base/jquery-ui.css" type="text/css" media="all" />

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
          window.location.reload();
        });

      };

      (function() {
        var e = document.createElement('script');
        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
      }());
    </script>

    <div id="FBC">
      {$fbcbutton}
      {option:logoutbutton}<a href="{$logoutbutton}"><img src="http://static.ak.fbcdn.net/rsrc.php/z2Y31/hash/cxrz4k7j.gif" alt="loginbtn"/></a>{/option:logoutbutton}
    </div>
    <fieldset>
    <legend>Register</legend>
    <form id="registerForm" action="register.php" method="post">
    <p>
        <label for="firstName">First name</label>
        <input type="text" name="firstName" id="firstName" value="{option:fname}{$fname}{/option:fname}"/>
    </p>
    <p>
        <label for="lastName">Last name</label>
        <input type="text" name="lastName" id="lastName" value="{option:lname}{$lname}{/option:lname}"/>
    </p>
    <p>
        <label for="userName">Username</label>
        <input type="text" name="userName" id="userName" value="{option:uname}{$uname}{/option:uname}"/>
    </p>
     <p>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" value=""/>
    </p>
    <p>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="{option:email}{$email}{/option:email}"/>
    </p>
    <p>
        <input type="hidden" value="{option:fb_uid}{$fb_uid}{/option:fb_uid}" id="fb_uid" name="fb_uid"/>
        <input type="submit" value="Join" id="registerButton"/>
    </p>
    </form>
    <div id="updateMessage"></div>
    <div id="loginButton"></div>
    </fieldset>

</div>
    
