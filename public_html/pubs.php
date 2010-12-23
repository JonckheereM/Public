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

/*
 * Start the login magic
 * @joenmaes
 */

// facebook php
require_once 'facebook/facebook.php';

// Create our Application instance
$facebook = new Facebook(array(
  'appId'  => '177481728946474',
  'secret' => '6d5db3a0e538eb5aa7bebe6ae0bb2efe',
  'cookie' => true,
));

$session = $facebook->getSession();

$me = null;
// Session based API call.
if ($session) {
  try {
    $uid = $facebook->getUser();
    $me = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
  }
}

// facebook javascript
$tpl->assign('appid', $facebook->getAppId());
$tpl->assign('session', json_encode($session));

/*
 * End the login magic
 * @joenmaes
 */

if(SpoonSession::exists('public_uid')){
    //show logout
    $tpl->assign('oLogout', true);
}

//Content layout
$tpl->assign('oNavPubs', true);

$lat = SpoonFilter::getGetValue('lat', null, '');
$long = SpoonFilter::getGetValue('long', null, '');
$pubs = array();

if ($lat !== "" && $long !== "") {
    $tpl->assign('latitude', $lat);
    $tpl->assign('longitude', $long);

    $pubs = Pub::getPubsByLocation($lat, $long);
    
    $abc = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    for($i = 0; $i< sizeof($pubs); $i++){
        $pub = new Pub($pubs[$i]["pub_id"]);

        $pubs[$i]["letter"] = substr($abc, $i, 1);;
        
        $pubs[$i]["people"] = $pub->getNumberPeople();
        $pubs[$i]["checkins"] = $pub->getNumberCheckins();
    }
} else {
    $tpl->assign('latitude', '""');
    $tpl->assign('longitude', '""');
}


if($pubs !== null){$tpl->assign('iPubs', $pubs);}
else{$tpl->assign('iPubs', array());}

$tpl->assign('intoHead', '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script>
        $(document).ready(function() {
            var longitude = {$longitude};
            var latitude = {$latitude};

            //Reverse Geocoding (Address Lookup)
            var geocoder = new google.maps.Geocoder();

            var latlng = new google.maps.LatLng(latitude, longitude);
            geocoder.geocode({"latLng": latlng}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        document.querySelector(".loc").innerHTML = results[0].formatted_address;
                    }
                } else {
                    alert("Geocoder failed due to: " + status);
                }
            });
        });
    </script>');

// show the output
$tpl->assign('content', $tpl->getContent('templates/pubs.tpl'));
$tpl->display('templates/layout.tpl');
?>
