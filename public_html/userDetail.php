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

    if(SpoonSession::exists('public_uid')){
        //show logout
        $tpl->assign('oLogout', true);
    }

    $user = new User(SpoonFilter::getGetValue('id', null, ''));

    if($user->user_id === null){
        SpoonHTTP::redirect('index.php');
    }
    $recent = $user->getRecentUserDrinks($user->user_id);

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


    if($user->GetTopPubs(5) !== null){
        $tpl->assign('oTopPubs', true);
        $tpl->assign('iTopPubs', $user->GetTopPubs(5));
    }else $tpl->assign('oNoTopPubs', true);

    $tpl->assign('fb_uid', $user->fb_uid);
    $tpl->assign('name',    $user->first_name.' '.$user->last_name);

    // if user is logged in and it's not his own profile show add as friend button
    // todo: if already friended
    if(SpoonSession::exists('public_uid') && SpoonSession::get('public_uid') != $user->user_id) $tpl->assign('oAddFriend', true);
// show the output
    $tpl->assign('content', $tpl->getContent('templates/userDetail.tpl'));
    $tpl->display('templates/layout.tpl');

?>
