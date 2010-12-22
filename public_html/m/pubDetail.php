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

$tpl->assign('pub_id', $pub->pub_id);
$tpl->assign('name', $pub->name);
$tpl->assign('people', $pub->getNumberPeople());
$tpl->assign('checkins', $pub->getNumberCheckins());

// show the output
$tpl->assign('content', $tpl->getContent('templates/pubDetail.tpl'));
$tpl->display('templates/template.tpl');
?>
