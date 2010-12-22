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
$pubs = array();

if ($lat !== "" && $long !== "") {
    $tpl->assign('latitude', $lat);
    $tpl->assign('longitude', $long);

    $pubs = Pub::getPubsByLocation($lat, $long);

    for($i = 0; $i< sizeof($pubs); $i++){
        $pub = new Pub($pubs[$i]['pub_id']);
        $distance = $pub->calculateDistance($lat, $long, "k");
        if($distance > 1)$pubs[$i]["distance"] = round($distance, 3).' kilometer';
        else $pubs[$i]["distance"] = (round($distance, 3)*1000).' meter';
    }
}else{
    $tpl->assign('latitude', "");
    $tpl->assign('longitude', "");
}

$tpl->assign('iPubs', $pubs);

// show the output
$tpl->assign('content', $tpl->getContent('templates/pubs.tpl'));
$tpl->display('templates/template.tpl');
?>
