<?php
date_default_timezone_set('Europe/Berlin');

// set include path
ini_set("include_path", ".:../library/");

// required classes
require_once 'spoon/spoon.php';

// facebook php
require_once 'facebook/facebook.php';

$tpl = new SpoonTemplate();
$tpl->setForceCompile(true);
$tpl->setCompileDirectory('./compiled_templates');

// check if the key exists
if(SpoonSession::exists('public_uid'))
{

    // Create our Application instance (replace this with your appId and secret).
     $facebook = new Facebook(array(
      'appId'  => '118234134911012',
      'secret' => 'a83b1fbf766dcf41a8238a13f53690bd',
      'cookie' => true,
    ));
    //$facebook->setSession(null);
    $session = $facebook->getSession();
    //spoon::dump($session);
    // Session based API call.
    if ($session) {
      try {

        $db = new SpoonDatabase('mysql', 'localhost', 'xqdchsmn_public', 'pRAcHU8Ajath7qa3', 'xqdchsmn_public');
        $record = array(); 
        //$record['fb_access_token'] = $facebook->getAccessToken();
        $record['fb_uid'] = $facebook->getUser();
        $record['fb_publish_stream'] = true;

        $uid = SpoonSession::get('public_uid');

        $rows = $db->update('users', $record, 'user_id = ?', $uid);

        SpoonHTTP::redirect('dashboardSettings.php');

      } catch (FacebookApiException $e) {
        error_log($e);
      }
    }else{
        $tpl->assign('fbcbutton', '<fb:login-button perms="email,publish_stream"></fb:login-button>');
        //http://developers.facebook.com/docs/authentication/permissions
    }

    // facebook javascript
    $tpl->assign('appid', $facebook->getAppId());

}else{
    SpoonHTTP::redirect('login.php');
}

// show the output
$tpl->display('templates/facebookconnect.tpl')
?>