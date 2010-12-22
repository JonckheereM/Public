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

        // show the output of get()
        $uid = SpoonSession::get('public_uid');

        // make a connection
        $db = new SpoonDatabase('mysql', 'localhost', 'xqdchsmn_public', 'pRAcHU8Ajath7qa3', 'xqdchsmn_public');

        $user = $db->getRecord('SELECT * FROM users WHERE user_id = ?', $uid);
        //Spoon::dump($user);
        $tpl->assign('fbu', $user['fb_uid']);
        $tpl->assign('uname', $user['username']);
        $tpl->assign('firstname', $user['first_name']);
        $tpl->assign('lastname', $user['last_name']);
        $tpl->assign('email', $user['mail']);

        //spoon::dump($user);

        //$tpl->assign('gender', $user['gender']);
        //$tpl->assign('weight', $user['weight']);
        //  $tpl->assign('birth', $user['birth_date']);
        //$tpl->assign('password', $user['password']);

        if($user['fb_publish_stream']){
            $tpl->assign('fbstatus', '<span style="color:green;">Authenticated</span>');

            //$tpl->assign('facebook', 'Access token: ' . $user['fb_access_token']);

            //$tpl->assign('facebook', '<a href="ajax/fbpost.php" class="button">Update status</a>');
            $tpl->assign('facebook', ' <input type="checkbox" id="twitterPublish" value="doPublish" checked/> Publish my check-ins to Facebook');

        }else{
            $tpl->assign('fbstatus', '<span style="color:red;">Not authenticated</span>');

            //$tpl->assign('facebook', '<input value="Connect" type="button" onclick="window.location.href=\'facebookconnect.php\'; " >');
            $tpl->assign('facebook', '<a href="facebookconnect.php" class="button">Connect</a>');

        }

        if($user['twitter_uid']){
            $tpl->assign('twitterstatus', '<span style="color:green;">Authenticated</span>');

            $tpl->assign('twitter', ' <input type="checkbox" id="facebookPublish" value="doPublish" checked/> Share my check-ins on Twitter');
            //$tpl->assign('twitter', '<a href="ajax/twitterpost.php" class="button">Tweet</a>');
        }else{
            $tpl->assign('twitterstatus', '<span style="color:red;">Not authenticated</span>');

            //$tpl->assign('twitter', '<input value="Connect" type="button" onclick="window.location.href=\'twitterconnect.php\'; " >');
            $tpl->assign('twitter', '<a href="twitterconnect.php" class="button">Connect</a>');
        }


    }else{ //GTFO!!!
        SpoonHTTP::redirect('index.php');
    }

    // show the output
    $tpl->assign('content', $tpl->getContent('templates/dashboardSettings.tpl'));
    $tpl->display('templates/layout.tpl');

?>