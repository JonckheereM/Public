<?php
    date_default_timezone_set('Europe/Berlin');

    // set include path
    ini_set("include_path", ".:../library/");

    // required classes
    require_once 'spoon/spoon.php';
    require_once 'publicApp/publicApp.php';

    $tpl = new SpoonTemplate();
    $tpl->setForceCompile(true);
    $tpl->setCompileDirectory('./compiled_templates');

    /*
     * Start the register magic
     * @joenmaes
     */

    // facebook php
    require_once 'facebook/facebook.php';

    // Create our Application instance
    $facebook = new Facebook(array(
      'appId'  => '177481728946474',
      'secret' => '6d5db3a0e538eb5aa7bebe6ae0bb2efe',
      'cookie' => true,
    ));

    $session = $facebook->getSession();

    $me = null;
    $uid = null;
    // Session based API call.
    if ($session) {
      try {
        $uid = $facebook->getUser();
        $me = $facebook->api('/me');
      } catch (FacebookApiException $e) {
        error_log($e);
      }
    }

    // facebook javascript
    $tpl->assign('appid', $facebook->getAppId());
    $tpl->assign('session', json_encode($session));

    // facebook buttons
    if (!$me){
        $tpl->assign('fbcbutton', '<fb:login-button perms="email"></fb:login-button>');
    }else{
        $tpl->assign('fbcbutton', '<p class="connected"><img src="img/check.png">Connected to Facebook<p>');

    }

    // fill in form
    if($me){
        //Spoon::dump($me);
        $tpl->assign('fname', $me['first_name']);
        $tpl->assign('lname', $me['last_name']);
        $tpl->assign('email', $me['email']);
        $tpl->assign('fb_uid', $uid);
    }

    // reeds ingelogd
    if(SpoonSession::exists('public_uid'))
    {
        SpoonHTTP::redirect('dashboard.php');
    }

     /*
     * End the register magic
     * @joenmaes
     */

    // show the output
    $tpl->assign('content', $tpl->getContent('templates/register.tpl'));
    $tpl->display('templates/layout.tpl');

?>
