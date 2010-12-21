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

$recentDrinks = PublicApp::getRecentDrinks();
$recentCheckins = PublicApp::getRecentCheckins();

$recent = array_merge($recentDrinks, $recentCheckins);

function compare_time($a, $b) {
    return strnatcmp($b['timestamp'], $a['timestamp']);
}

usort($recent, 'compare_time');
$test = array();
for ($i = 0; $i < 10; $i++) {
    if ($recent[$i] !== null
        )$test[] = $recent[$i];
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

// show the output
$tpl->assign('content', $tpl->getContent('templates/dashboard.tpl'));
$tpl->display('templates/template.tpl');
?>
