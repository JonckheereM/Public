<?php
date_default_timezone_set('Europe/Berlin');

// set include path
ini_set("include_path", ".:../library/");

// required classes
require_once 'spoon/spoon.php';
require_once 'publicApp/publicApp.php';

// facebook php
require_once 'facebook/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
      'appId'  => '177481728946474',
      'secret' => '6d5db3a0e538eb5aa7bebe6ae0bb2efe',
      'cookie' => true,
    ));

$session = $facebook->getSession();

// Session based API call.
if ($session) {
  try {
    $fb_uid = $facebook->getUser();

    $db = new SpoonDatabase('mysql', 'localhost', 'xqdchsmn_public', 'pRAcHU8Ajath7qa3', 'xqdchsmn_public');

    $var = $db->getRecord('SELECT * FROM users WHERE fb_uid = ?', $fb_uid);

    if(!empty($var)){
        spoonSession::start();
        SpoonSession::set('public_uid', $var['user_id']);

        SpoonHTTP::redirect('dashboard.php');
    }else{
        SpoonHTTP::redirect('register.php');
    }

  } catch (FacebookApiException $e) {
    error_log($e);
  }
}


?>
