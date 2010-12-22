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
$latestCheckIn = CheckIn::getLatestCheckinByUserId(SpoonSession::get('id'));

$timeAgo = (SpoonDate::getDate("H:i:s", strtotime($latestCheckIn->timestamp))) - SpoonDate::getDate("H:i:s");

$drink = new Drink(SpoonFilter::getGetValue('id', null, ''));

//User clicks on add drink button
if (SpoonFilter::getPostValue('btnAddDrink', null, '') !== "") {
    if($timeAgo < -6)SpoonHTTP::redirect('index.php');
    $latestCheckIn->AddTab(SpoonFilter::getPostValue('drink_id', null, ''));

    /*post to facebook*/
    $db = new SpoonDatabase('mysql', 'localhost', 'xqdchsmn_public', 'pRAcHU8Ajath7qa3', 'xqdchsmn_public');
    $user = $db->getRecord('SELECT * FROM users WHERE user_id = ?', SpoonSession::get('id'));
    $drink_id = SpoonFilter::getPostValue('drink_id', null, '');
    $drink = $db->getRecord('SELECT * FROM drinks WHERE drink_id = ?', $drink_id);

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
            $messageContent = 'I just drank a '.$drink['name'].' - http://publicapp.tk/drinks/'.$drink['drink_id'].'';
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
            $messageContent = 'I just drank a '.$drink['name'].' - http://publicapp.tk/drinks/'.$drink['drink_id'].'';


            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $twitter_token, $twitter_secret);
            $response = $connection->post('statuses/update', array('status' => $messageContent));
        }
    /*end*/

    SpoonHTTP::redirect('checkin.php');
}

if ($drink->drink_id === null || SpoonSession::exists('id') === false) {
    SpoonHTTP::redirect('index.php');
}


$recent = $drink->getRecent();

for ($i = 0; $i < sizeof($recent); $i++) {
    $recent[$i]['timestamp'] = SpoonDate::getTimeAgo(strtotime($recent[$i]['timestamp']));

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



if ($drink->getTop() !== null) {
    $tpl->assign('oTopDrinkers', true);
    $tpl->assign('iTopDrinkers', $drink->getTop());
}else
    $tpl->assign('oNoTopDrinkers', true);

$tpl->assign('drink_id', $drink->drink_id);
$tpl->assign('name', $drink->name);
$tpl->assign('abv', $drink->abv);

// show the output
$tpl->assign('content', $tpl->getContent('templates/drinkDetail.tpl'));
$tpl->display('templates/template.tpl');
?>
