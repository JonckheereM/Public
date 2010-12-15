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

$drink = new Drink(SpoonFilter::getGetValue('id'));

$tpl->assign('name', $drink->name);

$query = array(array('id' => NULL, 'name' => $drink->name, 'type' => '/food/beer'));
$query_envelope = array('query' => $query);
$service_url = 'http://api.freebase.com/api/service/mqlread';
$url = $service_url . '?query=' . urlencode(json_encode($query_envelope));

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

$results = json_decode($response)->result;


Spoon::dump($results);

$tpl->assign('drinks', $results[0]);

// show the output
$tpl->assign('content', $tpl->getContent('templates/drink.tpl'));
$tpl->display('templates/template.tpl');
?>
