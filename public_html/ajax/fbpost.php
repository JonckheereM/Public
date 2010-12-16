<?php

date_default_timezone_set('Europe/Berlin');

// set include path
ini_set("include_path", ".:../../../../../library/");

// required classes
require_once 'spoon/spoon.php';

require_once 'facebook/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '179777778699204',
  'secret' => 'c7afe4d28723505da1ca2e8e67593991',
  'cookie' => true,
));

if(SpoonSession::exists('public_uid'))
{
    
    $uid = SpoonSession::get('public_uid');
    $db = new SpoonDatabase('mysql', 'localhost', 'xqdchsmn_demo', 'Azerty123', 'xqdchsmn_demo');
    $user = $db->getRecord('SELECT * FROM users WHERE user_id = ?', $uid);

    $fb_uid = $user['fb_uid'];
    $messageContent = '[KOFFIEBOT] I am posting to this feed. I\'m awesome. I can\'t serve coffee.';

    $facebook->api($fb_uid.'/feed', 'post', array('message'=> $messageContent, 'cb' => ''));

    SpoonHTTP::redirect('../private.php');
}

?>
