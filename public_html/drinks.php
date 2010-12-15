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
    
    // show the output
    $tpl->assign('content', $tpl->getContent('templates/drinks.tpl'));
    $tpl->display('templates/layout.tpl');

?>