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
