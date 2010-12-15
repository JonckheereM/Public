<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl">
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

        <ul id="login">
          <li class="first"><a href="#">Login</a></li>
          <li><a href="#">Signup</a></li>
          <li><a href="#" class="imgreplacement">Login with Facebook</a></li>
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