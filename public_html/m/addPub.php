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

$lat = SpoonFilter::getGetValue('lat', null, '');
$long = SpoonFilter::getGetValue('long', null, '');

$tpl->assign('formaction', $_SERVER['PHP_SELF'].'?lat='.$lat.'&long='.$long);


$msgFault = '';
$pubname = SpoonFilter::getPostValue('pubname', null, '');

if (SpoonFilter::getPostValue('btnAdd', null, '')) {
    if ($pubname === "") {
        $msgFault = "Please fill in the name of the pub.";
    } else if ($lat !== "" && $long !== "") {
        $pub = new Pub('');
        $pub->name = $pubname;
        $pub->latitude = $lat;
        $pub->longitude = $long;
        $id = $pub->Add();
        SpoonHTTP::redirect('pubDetail.php?id='.$id);
    }
}

$tpl->assign('pubname', $pubname);
$tpl->assign('msgFault', $msgFault);
$tpl->assign('latitude', $lat);
$tpl->assign('longitude', $long);


// show the output
$tpl->assign('content', $tpl->getContent('templates/addPub.tpl'));
$tpl->display('templates/template.tpl');
?>
