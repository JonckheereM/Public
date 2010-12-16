<?php

date_default_timezone_set('Europe/Berlin');

// set include path
ini_set("include_path", ".:../../library/");

// required classes
require_once 'spoon/spoon.php';
require_once 'facebook/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
      'appId'  => '118234134911012',
      'secret' => 'a83b1fbf766dcf41a8238a13f53690bd',
      'cookie' => true,
    ));

if(SpoonSession::exists('public_uid'))
{
    
    $uid = SpoonSession::get('public_uid');
    $db = new SpoonDatabase('mysql', 'localhost', 'xqdchsmn_public', 'pRAcHU8Ajath7qa3', 'xqdchsmn_public');
    $user = $db->getRecord('SELECT * FROM users WHERE user_id = ?', $uid);

    $fb_uid = $user['fb_uid'];
    $messageContent = '[PUBLICAPP] www.publicapp.tk';

    $facebook->api($fb_uid.'/feed', 'post', array('message'=> $messageContent, 'cb' => ''));

    SpoonHTTP::redirect('../dashboardSettings.php');
}

?>
