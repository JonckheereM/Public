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

    // do I know you?
    if(SpoonSession::exists('public_uid')){
        $tpl->assign('oLogout', true);
        $tpl->assign('oNavMe', true);

        $uid = SpoonSession::get('public_uid');

        $db = new SpoonDatabase('mysql', 'localhost', 'xqdchsmn_public', 'pRAcHU8Ajath7qa3', 'xqdchsmn_public');
        $checkins = $db->getRecords('SELECT * FROM checkins WHERE user_id = ?', $uid);

        $user = new User($uid);

        $tpl->assign('daysActive', 'NOT ENOUGH DATA');

        $tpl->assign('checkins', count($checkins));

        $tpl->assign('avgDrinks', 'NOT ENOUGH DATA');
        
        $tpl->assign('avgDay', 'NOT ENOUGH DATA');

        $tpl->assign('topFriends', 'NOT ENOUGH DATA');

        if($user->GetTopPubs(5) !== null){
        $tpl->assign('oTopPubs', true);
            $tpl->assign('iTopPubs', $user->GetTopPubs(5));
        }else $tpl->assign('oNoTopPubs', true);

    }else{ //GTFO!!!
        SpoonHTTP::redirect('index.php');
    }

    // show the output
    $tpl->assign('content', $tpl->getContent('templates/dashboardStats.tpl'));
    $tpl->display('templates/layout.tpl');

?>