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
        $user = $db->getRecord('SELECT * FROM users WHERE user_id = ?', $uid);

         $tpl->assign('uname', $user['username']);
         $tpl->assign('fbu', $user['fb_uid']);

         $lastChecking = $db->getRecord('SELECT * FROM checkins WHERE user_id = ? ORDER BY timestamp DESC', $uid);
         $lastPub = $db->getRecord('SELECT * FROM pubs WHERE pub_id = ?', $lastChecking['pub_id']);

         $tpl->assign('lastPub', $lastPub['name']);
         $tpl->assign('lastPubId', $lastPub['pub_id']);
         $tpl->assign('lastDate', SpoonDate::getTimeAgo(strtotime($lastChecking['timestamp'])));

    }else{ //GTFO!!!
        SpoonHTTP::redirect('index.php');
    }

    // show the output
    $tpl->assign('content', $tpl->getContent('templates/dashboardStats.tpl'));
    $tpl->display('templates/layout.tpl');

?>