<?php

date_default_timezone_set('Europe/Berlin');

// set include path
ini_set("include_path", ".:../../library/");

// required classes
require_once 'spoon/spoon.php';
require_once('twitteroauth/twitteroauth.php');

define('CONSUMER_KEY', '4K5I4iPpEGc4KgTN1VnKDA');
define('CONSUMER_SECRET', 'cRWey0CbUXuD0qIrA89s9tKQjHtxQXRn8leR7AiI');
define('OAUTH_CALLBACK', 'http://www.publicapp.tk/twittercallback.php');

if(SpoonSession::exists('public_uid'))
{

    $uid = SpoonSession::get('public_uid');
    $db = new SpoonDatabase('mysql', 'localhost', 'xqdchsmn_public', 'pRAcHU8Ajath7qa3', 'xqdchsmn_public');
    $user = $db->getRecord('SELECT * FROM users WHERE user_id = ?', $uid);
    $twitter_token = $user['twitter_token'];
    $twitter_secret = $user['twitter_secret'];
    $messageContent = '[PUBLICAPP] www.publicapp.tk';


    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $twitter_token, $twitter_secret);
    $response = $connection->post('statuses/update', array('status' => $messageContent));

    SpoonHTTP::redirect('../dashboardSettings.php');
}