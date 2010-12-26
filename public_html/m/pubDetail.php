<?php

date_default_timezone_set('Europe/Berlin');

// set include path
ini_set("include_path", ".:../../library/");

// required classes
require_once 'spoon/spoon.php';
require_once 'publicApp/publicApp.php';

$tpl = new SpoonTemplate();
$tpl->setForceCompile(true);
$tpl->setCompileDirectory('./compiled_templates');
$tpl->assign('formaction', $_SERVER['PHP_SELF']);

SpoonSession::start();
//Content layout
if (SpoonSession::exists('id') === false) {
    SpoonHTTP::redirect('index.php');
}

$pub = new Pub(SpoonFilter::getGetValue('id', null, ''));

//User clicks on Check in button
if (SpoonFilter::getPostValue('btnCheckIn', null, '') !== "") {
    $check = new CheckIn('');
    $check->pub = new Pub(SpoonFilter::getPostValue('pub_id', null, ''));
    $check->user = new User(SpoonSession::get('id'));
    $id = $check->Add();

    $db = new SpoonDatabase('mysql', 'localhost', 'xqdchsmn_public', 'pRAcHU8Ajath7qa3', 'xqdchsmn_public');
    $user = $db->getRecord('SELECT * FROM users WHERE user_id = ?', SpoonSession::get('id'));

    /*post to facebook*/
        if($user['fb_publish_stream']){
            require_once 'facebook/facebook.php';

            // Create our Application instance (replace this with your appId and secret).
            $facebook = new Facebook(array(
                  'appId'  => '118234134911012',
                  'secret' => 'a83b1fbf766dcf41a8238a13f53690bd',
                  'cookie' => true,
                ));

            $uid = SpoonSession::get('id');
            $db = new SpoonDatabase('mysql', 'localhost', 'xqdchsmn_public', 'pRAcHU8Ajath7qa3', 'xqdchsmn_public');
            $user = $db->getRecord('SELECT * FROM users WHERE user_id = ?', $uid);

            $fb_uid = $user['fb_uid'];
            $messageContent = 'I\'m at '.$check->pub->name.' - http://publicapp.tk/pubs/'.$check->pub->pub_id.'';
            $facebook->api($fb_uid.'/feed', 'post', array('message'=> $messageContent, 'cb' => ''));
        }

    /*end*/

    /*post to twitter*/
        if($user['twitter_uid']){
            require_once('twitteroauth/twitteroauth.php');

            define('CONSUMER_KEY', '4K5I4iPpEGc4KgTN1VnKDA');
            define('CONSUMER_SECRET', 'cRWey0CbUXuD0qIrA89s9tKQjHtxQXRn8leR7AiI');
            define('OAUTH_CALLBACK', 'http://www.publicapp.tk/twittercallback.php');

            $uid = SpoonSession::get('id');
            $db = new SpoonDatabase('mysql', 'localhost', 'xqdchsmn_public', 'pRAcHU8Ajath7qa3', 'xqdchsmn_public');
            $user = $db->getRecord('SELECT * FROM users WHERE user_id = ?', $uid);
            $twitter_token = $user['twitter_token'];
            $twitter_secret = $user['twitter_secret'];
            $messageContent = 'I\'m at '.$check->pub->name.' - http://publicapp.tk/pubs/'.$check->pub->pub_id.'';


            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $twitter_token, $twitter_secret);
            $response = $connection->post('statuses/update', array('status' => $messageContent));
        }
    /*end*/

    SpoonHTTP::redirect('checkin.php');
}

if ($pub->pub_id === null) {
    SpoonHTTP::redirect('index.php');
}

$recent = CheckIn::getCheckinsByPubId($pub->pub_id);

for ($i = 0; $i < sizeof($recent); $i++) {
    $recent[$i]['timestamp'] = SpoonDate::getTimeAgo(strtotime($recent[$i]['timestamp']));

    //check if the user has a fb account authenticated
    if(!$recent[$i]['fb_uid']){
        //else, use standard fb icon
        $recent[$i]['fb_uid'] = 1;
    }
}

if ($recent !== null) {
    $tpl->assign('oRecent', true);
    $tpl->assign('iRecent', $recent);
}
else
    $tpl->assign('oNoRecent', true);

$tpl->assign('longitude', $pub->longitude);
$tpl->assign('latitude', $pub->latitude);
$tpl->assign('pub_id', $pub->pub_id);
$tpl->assign('name', $pub->name);
$tpl->assign('people', $pub->getNumberPeople());
$tpl->assign('checkins', $pub->getNumberCheckins());

// show the output
$tpl->assign('content', $tpl->getContent('templates/pubDetail.tpl'));
$tpl->display('templates/template.tpl');
?>
