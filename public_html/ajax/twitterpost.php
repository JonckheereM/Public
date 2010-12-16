<?php

date_default_timezone_set('Europe/Berlin');

// set include path
ini_set("include_path", ".:../../../../../library/");

// required classes
require_once 'spoon/spoon.php';
require_once('twitteroauth/twitteroauth.php');

define('CONSUMER_KEY', 'LK6Hid8ItWBTjTpYojP66Q');
define('CONSUMER_SECRET', 'xqmzjjxs6eNhxD0rRXJVxcsA9dwgeudgPAQwRoRsU');
define('OAUTH_CALLBACK', 'http://www.jeroenmaes.eu/demo/public/fbregister/twittercallback.php');

if(SpoonSession::exists('public_uid'))
{

    $uid = SpoonSession::get('public_uid');
    $db = new SpoonDatabase('mysql', 'localhost', 'xqdchsmn_demo', 'Azerty123', 'xqdchsmn_demo');
    $user = $db->getRecord('SELECT * FROM users WHERE user_id = ?', $uid);
    $twitter_token = $user['twitter_token'];
    $twitter_secret = $user['twitter_secret'];
    $messageContent = '[KOFFIEBOT] I am posting to this feed. I\'m awesome. I can\'t serve coffee.';


    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $twitter_token, $twitter_secret);
    $response = $connection->post('statuses/update', array('status' => $messageContent));
    //spoon::dump($response);
    //note: status update can't be duplicate!!!

    SpoonHTTP::redirect('../private.php');
}