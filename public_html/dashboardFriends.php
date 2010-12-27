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
        
        $user = new User($uid);
        if($user->GetFollowing() != null)
        {
          $values = $user->GetFollowing();
          $following = array();
          foreach($values as $value)
          {
            $userFollowing = new User($value['friend']);
            if($userFollowing->fb_uid == null) $userFollowing->fb_uid = 1;
            array_push($following, get_object_vars($userFollowing));
          }
          $tpl->assign('oFollowing', true);
          $tpl->assign('iFollowing', $following);
        }
        else
        {
          $tpl->assign('oNoFollowing', true);
        }

        if($user->GetFollowers() != null)
        {
          $values = $user->GetFollowers();
          $followers = array();
          foreach($values as $value)
          {
            $userFollower = new User($value['user_id']);
            if($userFollower->fb_uid == null) $userFollower->fb_uid = 1;
            array_push($followers, get_object_vars($userFollower));
          }
          $tpl->assign('oFollowers', true);
          $tpl->assign('iFollowers', $followers);
        }
        else
        {
          $tpl->assign('oNoFollowers', true);
        }


    }else{ //GTFO!!!
        SpoonHTTP::redirect('index.php');
    }

    // show the output
    $tpl->assign('content', $tpl->getContent('templates/dashboardFriends.tpl'));
    $tpl->display('templates/layout.tpl');

?>