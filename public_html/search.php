<?php

/*
 * search page for public
 *
 * @author  Jeroen Maes
 * @author  Maxime Jonckheere
 * @author  Jeroen Neyt
 * 
 */

date_default_timezone_set('Europe/Berlin');

// set include path
ini_set("include_path", ".:../library/");

// required classes
require_once 'spoon/spoon.php';
require_once 'publicApp/publicApp.php';

$tpl = new SpoonTemplate();
$tpl->setForceCompile(true);
$tpl->setCompileDirectory('./compiled_templates');

// get search query from url
$query = SpoonFilter::getGetValue('q', null, '');

$tpl->assign('query', $query);

// show the output
$tpl->assign('content', $tpl->getContent('templates/search.tpl'));
$tpl->display('templates/layout.tpl');
?>
