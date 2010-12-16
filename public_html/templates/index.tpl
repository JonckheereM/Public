
<div id="introduction" class="fluid">
    <div class="container">
        <div id="summary">
            <h2>Find out <em>where</em> and <em>what</em> your friends are drinking</h2>
            <img src="img/dev/map-summary.png" alt="summary map" width="350px" height="230px" />
        </div>

        <div id="features">
            <h2>Some of the great <em>features</em></h2>
            <ul>
                <li id="mobile">
                    <span class="title">Mobile website</span>
                    Use our mobile website to check in in your favourite pubs and discover new pubs
                </li>
                <li id="track">
                    <span class="title">Track information</span>
                    Track information about your drinking habits and those of your friends
                </li>
                <li id="discover">
                    <span class="title">Discover</span>
                    Discover new drinks and pubs in cities you have never been to
                </li>
                <li id="share">
                    <span class="title">Share</span>
                    Share information on other social networks like Twitter and Facebook
                </li>
            </ul>
        </div>
        <p><span class="highlight">Great isn't it? Try it!</span><a href="register.php" class="button">Sign up now</a></p>

    </div>
</div>

<div id="content" class="fluid">
    <div class="container">
        <div id="recent-activity">
            <h2>Recent activity</h2>

            {option:oRecent}
            {iteration:iRecent}
            <div class="activity">
                <img src="img/thumbs/{$iRecent.username}.jpg" alt="avatar {$iRecent.username}" width="32px" height="32px" />
                {option:iRecent.drink_id}<p><span class="person"><a href="#">{$iRecent.username}</a></span> just drank a <span class="drink"><a href="drinkDetail.php?id={$iRecent.drink_id}">{$iRecent.drinkname}</a></span> in <span class="pub"><a href="pubDetail.php?id={$iRecent.pub_id}">{$iRecent.pubname}</a></span></p>{/option:iRecent.drink_id}
                {option:iRecent.checkin_id}<p><span class="person"><a href="#">{$iRecent.username}</a></span> just arrived at <span class="pub"><a href="pubDetail.php?id={$iRecent.pub_id}">Backdoor</a></span></p>{/option:iRecent.checkin_id}
                <p><span class="timespan">{$iRecent.timestamp}</span></p>
            </div>
            {/iteration:iRecent}
            {/option:oRecent}
            {option:oNoRecent}
            <p>No recent activities.</p>
            {/option:oNoRecent}
            <!--<div class="activity">
                <img src="img/thumbs/mmphs.jpg" alt="avatar mmphs" width="32px" height="32px" />
                <p><span class="person"><a href="#">mmphs</a></span> just arrived at <span class="pub"><a href="#">Backdoor</a></span></p>
            </div>
            <div class="activity">
                <img src="img/thumbs/joenmaes.jpg" alt="avatar joenmaes" width="32px" height="32px" />
                <p><span class="person"><a href="#">joenmaes</a></span> just drank a <span class="drink"><a href="#">Duvel</a></span> in <span class="pub"><a href="#">Backdoor</a></span></p>
            </div>-->
        </div>
        <div id="location">
            <h2>Your location</h2>
            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
            <article>
                <p id="finding">Finding your location: <span id="status">Locating...</span></p>
            </article>

            <script>

                var longitude = {$longitude};
                var latitude = {$latitude};
                
                //location found
                function success(position) {
                    window.location.href = "http://publicapp.tk/index.php?lat=" + position.coords.latitude + "&long=" + position.coords.longitude;
                    //window.location.href = "http://localhost:8888/Public/public_html/index.php?lat=" + position.coords.latitude + "&long=" + position.coords.longitude;
                }
                if(longitude != "" && latitude != ""){
                    document.querySelector('#finding').innerHTML = '';

                    

                    var mapcanvas = document.createElement('div');
                    mapcanvas.id = 'mapcanvas';
                    mapcanvas.style.height = '200px';
                    mapcanvas.style.width = '360px';

                    document.querySelector('article').appendChild(mapcanvas);

                    //Geolocation
                    var latlng = new google.maps.LatLng(latitude, longitude);
                    var myOptions = {
                        zoom: 15,
                        center: latlng,
                        mapTypeControl: false,
                        navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                    var map = new google.maps.Map(document.getElementById("mapcanvas"), myOptions);

                    var marker = new google.maps.Marker({
                        position: latlng,
                        icon: new google.maps.MarkerImage("http://www.google.com/mapfiles/arrow.png"),
                        shadow: new google.maps.MarkerImage("http://www.google.com/mapfiles/arrowshadow.png"),
                        map: map,
                        title:"You are here!"
                    });

                    var youwindow = new google.maps.InfoWindow({
                        content: "<h3>You are here!</h3>"
                    });
                    google.maps.event.addListener(marker, 'click', function() {
                        youwindow.open(map,marker);
                    });

                    //Pubs on the map
                    {iteration:iPubs}
                    var latlngPub = new google.maps.LatLng({$iPubs.latitude}, {$iPubs.longitude});
                    var pubMarker{$iPubs.pub_id} = new google.maps.Marker({
                        position: latlngPub,
                        icon: new google.maps.MarkerImage("http://www.google.com/mapfiles/marker{$iPubs.letter}.png"),
                        map: map,
                        title:"{$iPubs.name}!"
                    });

                    var contentString = '<h3><a href="pubDetail.php?id={$iPubs.pub_id}">{$iPubs.name}</a></h3>';

                    var infowindow{$iPubs.pub_id} = new google.maps.InfoWindow({
                        content: contentString
                    });
                    google.maps.event.addListener(pubMarker{$iPubs.pub_id}, 'click', function() {
                        infowindow{$iPubs.pub_id}.open(map, pubMarker{$iPubs.pub_id});
                    });

                    {/iteration:iPubs}

                }
                //error handling
                function error(msg) {
                    var s = document.querySelector('#status');
                    s.innerHTML = typeof msg == 'string' ? msg : "failed";
                    s.className = 'fail';
                }

                //get location
                if (navigator.geolocation && longitude == "" && latitude == "") {
                    navigator.geolocation.getCurrentPosition(success, error, {enableHighAccuracy: true});
                } else {
                    error('not supported');
                }
            </script>
            <h2>Popular pubs in your neighbourhood</h2>
            <ol>
                {iteration:iPubs}
                <li><a href="pubDetail.php?id={$iPubs.pub_id}">{$iPubs.name}</a></li>
                {/iteration:iPubs}
            </ol>
        </div>
    </div>
</div>
