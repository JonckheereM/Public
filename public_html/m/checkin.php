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

$timeAgo = (SpoonDate::getDate("H:i:s", strtotime($latestCheckIn->timestamp)))- SpoonDate::getDate("H:i:s");

//If the checkin is within 5 hours
if($timeAgo > -6){
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
    $tpl->assign('iTabs', $latestCheckIn->getTabs());
}else{
    $tpl->assign('oNoCheckIn', true);
}




// show the output
$tpl->assign('content', $tpl->getContent('templates/checkin.tpl'));
$tpl->display('templates/template.tpl');
?>
