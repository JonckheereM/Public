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
    $pub = new Pub(SpoonFilter::getGetValue('id', null, ''));

    if(SpoonSession::exists('public_uid')){
        //show logout
        $tpl->assign('oLogout', true);
    }
    

    if($pub->pub_id === null){
        SpoonHTTP::redirect('index.php');
    }

    $recent = CheckIn::getCheckinsByPubId($pub->pub_id);

    for($i = 0; $i < sizeof($recent); $i++){
        $recent[$i]['timestamp']= SpoonDate::getTimeAgo(strtotime($recent[$i]['timestamp']));
        
        //check if the user has a fb account authenticated
        if(!$recent[$i]['fb_uid']){
            //else, use standard fb icon
            $recent[$i]['fb_uid'] = 1;
        }
    }

    if($recent !== null){
        $tpl->assign('oRecent', true);
        $tpl->assign('iRecent', $recent);
    }
    else $tpl->assign('oNoRecent', true);

    if(CheckIn::getTopCheckinsByPubId($pub->pub_id) !== null){
        $tpl->assign('oTopCheckins', true);
        $tpl->assign('iTopCheckins', CheckIn::getTopCheckinsByPubId($pub->pub_id));
    }
    else $tpl->assign('oNoTopCheckins', true);

    $tpl->assign('name',        $pub->name);
    $tpl->assign('longitude',   $pub->longitude);
    $tpl->assign('latitude',    $pub->latitude);
    $tpl->assign('people',      $pub->getNumberPeople());
    $tpl->assign('checkins',    $pub->getNumberCheckins());

    // show the output
    $tpl->assign('content', $tpl->getContent('templates/pubDetail.tpl'));
    $tpl->display('templates/layout.tpl');

?>
