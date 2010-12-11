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

//Content layout

$msgFirst_name = '';
$msgLast_name = '';
$msgUsername = '';
$msgMail = '';
$msgPassword = '';

$first_name = SpoonFilter::getPostValue('first_name', null, '');
$last_name = SpoonFilter::getPostValue('last_name', null, '');
$username = SpoonFilter::getPostValue('username', null, '');
$mail = SpoonFilter::getPostValue('mail', null, '');
$password = SpoonFilter::getPostValue('password', null, '');

if (SpoonFilter::getPostValue('btnSignup', null, '') !== "") {
    // allOk?
    $allOk = true;

    // check first name
    if ($first_name === "") {
        $msgFirst_name = 'please fill in your first name';
        $allOk = false;
    }
    // check last name
    if ($last_name === "") {
        $msgLast_name = 'please fill in your last name';
        $allOk = false;
    }
    // check username
    if ($username === "") {
        $msgUsername = 'please fill a username';
        $allOk = false;
    } else
    // User already exists
    if (User::existsUser($username) !== false) {
        $msgUsername = 'this username is already taken';
        $allOk = false;
    }
    // check mail
    if ($mail === "") {
        $msgMail = 'please fill in your mail address';
        $allOk = false;
    } else
    // check if is right format
    if (!SpoonFilter::isEmail($mail)) {
        $msgMail = 'please fill in a correct mail address';
        $allOk = false;
    }
    // check password
    if ($password === "") {
        $msgPassword = 'please fill in a password';
        $allOk = false;
    }

    if ($allOk === true) {
        $user = new User();
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->username = $username;
        $user->mail = $mail;
        $user->password = $password;
        $user->Add();
        SpoonSession::start();
        SpoonSession::set('id', $user->user_id);
        SpoonHTTP::redirect('dashboard.php');
    }
}

$tpl->assign('first_name', $first_name);
$tpl->assign('last_name', $last_name);
$tpl->assign('username', $username);
$tpl->assign('mail', $mail);
$tpl->assign('password', $password);

$tpl->assign('msgFirst_name', $msgFirst_name);
$tpl->assign('msgLast_name', $msgLast_name);
$tpl->assign('msgUsername', $msgUsername);
$tpl->assign('msgMail', $msgMail);
$tpl->assign('msgPassword', $msgPassword);

// show the output
$tpl->assign('content', $tpl->getContent('templates/register.tpl'));
$tpl->display('templates/template.tpl');
?>
