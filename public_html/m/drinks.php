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

$drinks = Drink::getAllDrinks();

$tpl->assign('iDrinks', $drinks);

// show the output
$tpl->assign('content', $tpl->getContent('templates/drinks.tpl'));
$tpl->display('templates/template.tpl');
?>
