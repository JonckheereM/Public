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
    
    //Content layout
    
    //*************************************************
    //Gewoon wa voorbeeldjes
    $checkin 	= new CheckIn(1);
    $user		= new User(1);
    $drink		= new Drink(1);
    $pub		= new Pub(1);
    
    $tpl->assign('pub',		$checkin->pub->name);
    $tpl->assign('user', 	$user->username);
    $tpl->assign('friend', 	$user->friends[0]->username);
    $tpl->assign('drink', 	$drink->name);
    $tpl->assign('tab', 	$checkin->tabs[0]->drink->name);
    
    $user->username = 'JonckheereM';
    $user->Update();
    //*************************************************
    
    // show the output
    $tpl->display('templates/index.tpl');

?>
