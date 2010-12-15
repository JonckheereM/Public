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
    
    $drink = new Drink(SpoonFilter::getGetValue('id', null, ''));

    if($drink->drink_id === null){
        SpoonHTTP::redirect('index.php');
    }
    $recent = $drink->getRecent();

    for($i = 0; $i < sizeof($recent); $i++){
        $recent[$i]['timestamp']= SpoonDate::getTimeAgo(strtotime($recent[$i]['timestamp']));
    }

    

    if($recent !== null){
        $tpl->assign('oRecent', true);
        $tpl->assign('iRecent', $recent);
    }
    else $tpl->assign('oNoRecent', true);


    
    if($drink->getTop() !== null){
        $tpl->assign('oTopDrinkers', true);
        $tpl->assign('iTopDrinkers', $drink->getTop());
    }else $tpl->assign('oNoTopDrinkers', true);
    
    $tpl->assign('name',    $drink->name);
    $tpl->assign('abv',     $drink->abv);
    
    // show the output
    $tpl->assign('content', $tpl->getContent('templates/drinkDetail.tpl'));
    $tpl->display('templates/layout.tpl');

?>
