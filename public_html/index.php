<?php

date_default_timezone_set('Europe/Berlin');

// set include path
ini_set("include_path", ".:../library/");

// required classes
require_once 'spoon/spoon.php';
require_once 'publicApp/publicApp.php';

$tpl = new SpoonTemplate();
$tpl->setForceCompile(true);
$tpl->setCompileDirectory('./compiled_templates');


//Content layout
$tpl->assign('oNavHome', true);

$lat = SpoonFilter::getGetValue('lat', null, '');
$long = SpoonFilter::getGetValue('long', null, '');
$pubs = array();

if ($lat !== "" && $long !== "") {
    $tpl->assign('latitude', $lat);
    $tpl->assign('longitude', $long);

    $pubs = Pub::getPubsByLocation($lat, $long);
} else {
    $tpl->assign('latitude', "");
    $tpl->assign('longitude', "");
}

$tpl->assign('iPubs', $pubs);

$recentDrinks = PublicApp::getRecentDrinks();
$recentCheckins = PublicApp::getRecentCheckins();

$recent = array_merge($recentDrinks, $recentCheckins);

function compare_time($a, $b) {
    return strnatcmp($b['timestamp'], $a['timestamp']);
}


usort($recent, 'compare_time');
$test = array();
for ($i = 0; $i<10 ; $i++){
    if($recent[$i] !== null)$test[] = $recent[$i];
}

$recent = $test;

for ($i = 0; $i < sizeof($recent); $i++) {
    $recent[$i]['timestamp'] = SpoonDate::getTimeAgo(strtotime($recent[$i]['timestamp']));
}

if ($recent !== null) {
    $tpl->assign('oRecent', true);
    $tpl->assign('iRecent', $recent);
}
else
    $tpl->assign('oNoRecent', true);

/*
 * Start the login magic
 * @joenmaes
 */

// facebook php
require_once 'facebook/facebook.php';

// Create our Application instance
$facebook = new Facebook(array(
  'appId'  => '177481728946474',
  'secret' => '6d5db3a0e538eb5aa7bebe6ae0bb2efe',
  'cookie' => true,
));

$session = $facebook->getSession();

$me = null;
// Session based API call.
if ($session) {
  try {
    $uid = $facebook->getUser();
    $me = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
  }
}

// facebook javascript
$tpl->assign('appid', $facebook->getAppId());
$tpl->assign('session', json_encode($session));


/*
 * End the login magic
 * @joenmaes
 */

// show the output
$tpl->assign('content', $tpl->getContent('templates/index.tpl'));
$tpl->display('templates/layout.tpl');
?>
