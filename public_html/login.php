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
     * Start the login magic
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


    // reeds ingelogd
    if(SpoonSession::exists('public_uid'))
    {
        SpoonHTTP::redirect('dashboard.php');
    }

    // inloggen
    // momenteel enkel via username, moet ook via email kunnen!!!
    $email = SpoonFilter::getPostValue('email', null, null);
    $password = SpoonFilter::getPostValue('password', null, null);

    if($email && $password){

        $check = User::existsUser($email);        
        if ($check && $check->password === md5($password)) {

            spoonSession::start();
            SpoonSession::set('public_uid', $check->user_id);
            SpoonHTTP::redirect('dashboard.php');
        }

    }

    /*
     * End the login magic
     * @joenmaes
     */

    // show the output
    $tpl->assign('content', $tpl->getContent('templates/login.tpl'));
    $tpl->display('templates/layout.tpl');

?>

