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

SpoonSession::start();
//Content layout
if (SpoonSession::exists('id') === false) {
    SpoonHTTP::redirect('index.php');
}

$latestCheckIn = CheckIn::getLatestCheckinByUserId(SpoonSession::get('id'));

$timeAgo = SpoonDate::getDate("H:i:s") - (SpoonDate::getDate("H:i:s", strtotime($latestCheckIn->timestamp)));

//If the checkin is within 5 hours
//if($timeAgo > -6){
    $tpl->assign('oCheckIn', true);

    if(SpoonFilter::getGetValue('event', null, '') === 'plus'){
        $latestCheckIn->AddTab(SpoonFilter::getGetValue('drinkid', null, ''));
        SpoonHTTP::redirect('checkin.php');
    }else if(SpoonFilter::getGetValue('event', null, '') === 'min'){
        $latestCheckIn->DeleteTab(SpoonFilter::getGetValue('drinkid', null, ''));
        SpoonHTTP::redirect('checkin.php');
    }

    $tpl->assign('pub_id', $latestCheckIn->pub->pub_id);
    $tpl->assign('name', $latestCheckIn->pub->name);
    $tpl->assign('people', $latestCheckIn->pub->getNumberPeople());
    $tpl->assign('checkins', $latestCheckIn->pub->getNumberCheckins());
    $tabs = $latestCheckIn->getTabs();
    if($tabs[0] !== null){$tpl->assign('iTabs', $tabs);$tpl->assign('oTabs', true);}
    else{$tpl->assign('iTabs', array());$tpl->assign('oNoTabs', true);}
//}else{
//    $tpl->assign('oNoCheckIn', true);
//}


$user = new User(SpoonSession::exists('id'));
if($user->weight !== null && $user->gender !== null){
    $drinks = $latestCheckIn->getNumberTabs();
    $isLegal = $user->isLegalToDrive((int)$drinks["count"], $timeAgo);
    if($isLegal)$tpl->assign('oLegalToDrive', true);
    else $tpl->assign('oNotLegalToDrive', true);
}else $tpl->assign('oNotAbleLegalToDrive', true);



// show the output
$tpl->assign('content', $tpl->getContent('templates/checkin.tpl'));
$tpl->display('templates/template.tpl');
?>
