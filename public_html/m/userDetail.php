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

$user = new User(SpoonFilter::getGetValue('id', null, ''));

if ($user->user_id === null || SpoonSession::exists('id') === false) {
    SpoonHTTP::redirect('index.php');
}


$recent = $user->getRecentUserDrinks($user->user_id);

for ($i = 0; $i < sizeof($recent); $i++) {
    $recent[$i]['timestamp'] = SpoonDate::getTimeAgo(strtotime($recent[$i]['timestamp']));

    if (!$recent[$i]['fb_uid']) {
        //else, use standard fb icon
        $recent[$i]['fb_uid'] = 1;
        $user->fb_uid = 1;
    }
}


if ($recent !== null) {
    $tpl->assign('oRecent', true);
    $tpl->assign('iRecent', $recent);
}
else
    $tpl->assign('oNoRecent', true);


$tpl->assign('user_id', $user->user_id);
$tpl->assign('username', $user->username);
$tpl->assign('fb_uid', $user->fb_uid);

// show the output
$tpl->assign('content', $tpl->getContent('templates/userDetail.tpl'));
$tpl->display('templates/template.tpl');
?>
