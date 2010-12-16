<?php

date_default_timezone_set('Europe/Berlin');

// set include path
ini_set("include_path", ".:../library/");

// required classes
require_once 'spoon/spoon.php';
if(SpoonSession::exists('public_uid'))
{
    SpoonSession::delete('public_uid');
    SpoonHTTP::redirect('login.php');
}else{
    SpoonHTTP::redirect('login.php');
}
?>
