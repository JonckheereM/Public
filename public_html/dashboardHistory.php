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

         /*code max*/
         $recentDrinks = PublicApp::getRecentUserDrinks(10);
        $recentCheckins = PublicApp::getRecentUserCheckins(10);

        $recent = array_merge($recentDrinks, $recentCheckins);

        function compare_time($a, $b) {
            return strnatcmp($b['timestamp'], $a['timestamp']);
        }

        usort($recent, 'compare_time');
        $test = array();
        for ($i = 0; $i<100 ; $i++){
            if($recent[$i] !== null)$test[] = $recent[$i];
        }

        $recent = $test;

        for ($i = 0; $i < sizeof($recent); $i++) {
            $recent[$i]['timestamp'] = SpoonDate::getTimeAgo(strtotime($recent[$i]['timestamp']));

            //check if the user has a fb account authenticated
            if(!$recent[$i]['fb_uid']){
                //else, use standard fb icon
                $recent[$i]['fb_uid'] = 1;
            }
        }

        if ($recent !== null) {
            //$tpl->assign('oRecent', true);
            $tpl->assign('iRecent', $recent);
        }
        //else
            //$tpl->assign('oNoRecent', true);
         /*end code max*/


    }else{ //GTFO!!!
        SpoonHTTP::redirect('index.php');
    }

    // show the output
    $tpl->assign('content', $tpl->getContent('templates/dashboardHistory.tpl'));
    $tpl->display('templates/layout.tpl');

?>