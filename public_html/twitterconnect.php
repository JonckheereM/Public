<?php
date_default_timezone_set('Europe/Berlin');

// set include path
ini_set("include_path", ".:../library/");

// required classes
require_once 'spoon/spoon.php';

session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('twitterconfig.php');

if(SpoonSession::exists('public_uid'))
{

    /* If access tokens are not available redirect to connect page. */
    if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
        echo '<a href="twitterredirect.php"><img src="img/lighter.png" alt="Sign in with Twitter"/></a>';
    }else{
        /* Get user access tokens out of the session. */
        $access_token = $_SESSION['access_token'];

        $uid = SpoonSession::get('public_uid');
        $db = new SpoonDatabase('mysql', 'localhost', 'xqdchsmn_public', 'pRAcHU8Ajath7qa3', 'xqdchsmn_public');
        $record = array();
        $record['twitter_uid'] = $access_token['user_id'];
        $record['twitter_token'] = $access_token['oauth_token'];
        $record['twitter_secret'] = $access_token['oauth_token_secret'];
        $rows = $db->update('users', $record, 'user_id = ?', $uid);
        SpoonHTTP::redirect('dashboardSettings.php');
    }
}else{
    SpoonHTTP::redirect('login.php');
}
?>
