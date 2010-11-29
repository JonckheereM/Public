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

SpoonSession::start();

//Content layout
if (SpoonSession::get('id') !== false) {
    SpoonHTTP::redirect('dashboard.php');
}
$msgFault = '';

$username = SpoonFilter::getPostValue('username', null, '');
$password = SpoonFilter::getPostValue('password', null, '');


if (SpoonFilter::getPostValue('btnSignin', null, '') !== "") {
    $check = User::existsUser($username);
    if ($check !== false && $check->password === $password) {
        
        SpoonSession::set('id', $check->user_id);
        SpoonHTTP::redirect('dashboard.php');
    } else {
        $msgFault = 'Wrong combination';
    }
}

$tpl->assign('username', $username);
$tpl->assign('password', $password);

$tpl->assign('msgFault', $msgFault);

// show the output
$tpl->display('templates/index.tpl');
?>
