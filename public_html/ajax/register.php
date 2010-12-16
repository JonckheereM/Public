<?php

date_default_timezone_set('Europe/Berlin');

// set include path
ini_set("include_path", ".:../../library/");

// required classes
require_once 'spoon/spoon.php';
require_once 'publicApp/publicApp.php';

$user = new User();

    $user->first_name = SpoonFilter::getPostValue('fname');
    $user->last_name = SpoonFilter::getPostValue('lname');
    $user->username = SpoonFilter::getPostValue('uname');
    $user->mail = SpoonFilter::getPostValue('email');
    $user->password = md5(SpoonFilter::getPostValue('password'));

    $fb_uid = SpoonFilter::getPostValue('fb_uid');
    if($fb_uid != ''){
        $user->fb_uid = SpoonFilter::getPostValue('fb_uid');
    }

    $user->Add();

?>
