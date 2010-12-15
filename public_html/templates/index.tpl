
<div id="introduction" class="fluid">
    <div class="container">
        <div id="summary">
            <h2>Find out <em>where</em> and <em>what</em> your friends are drinking</h2>
            <img src="/img/dev/map-summary.png" alt="summary map" width="350px" height="230px" />
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
        <p><span class="highlight">Great isn't it? Try it!</span><a href="#" class="button">Sign up now</a></p>

    </div>
</div>

<div id="content" class="fluid">
    <div class="container">
        <div id="recent-activity">
            <h2>Recent activity</h2>
            <div class="activity">
                <img src="/img/thumbs/mmphs.jpg" alt="avatar mmphs" width="32px" height="32px" />
                <p><span class="person"><a href="#">mmphs</a></span> just arrived at <span class="pub"><a href="#">Backdoor</a></span></p>
            </div>
            <div class="activity">
                <img src="/img/thumbs/joenmaes.jpg" alt="avatar joenmaes" width="32px" height="32px" />
                <p><span class="person"><a href="#">joenmaes</a></span> just drank a <span class="drink"><a href="#">Duvel</a></span> in <span class="pub"><a href="#">Backdoor</a></span></p>
            </div>
            <div class="activity">
                <img src="/img/thumbs/jonckheereM.jpg" alt="avatar jonckheereM" width="32px" height="32px" />
                <p><span class="person"><a href="#">jonckheereM</a></span> just drank a <span class="drink"><a href="#">Malheur</a></span> in <span class="pub"><a href="#">Backdoor</a></span></p>
            </div>
            <div class="activity">
                <img src="/img/thumbs/mmphs.jpg" alt="avatar mmphs" width="32px" height="32px" />
                <p><span class="person"><a href="#">mmphs</a></span> just arrived at <span class="pub"><a href="#">Backdoor</a></span></p>
            </div>
            <div class="activity">
                <img src="/img/thumbs/joenmaes.jpg" alt="avatar joenmaes" width="32px" height="32px" />
                <p><span class="person"><a href="#">joenmaes</a></span> just drank a <span class="drink"><a href="#">Duvel</a></span> in <span class="pub"><a href="#">Backdoor</a></span></p>
            </div>
            <div class="activity">
                <img src="/img/thumbs/jonckheereM.jpg" alt="avatar jonckheereM" width="32px" height="32px" />
                <p><span class="person"><a href="#">jonckheereM</a></span> just drank a <span class="drink"><a href="#">Malheur</a></span> in <span class="pub"><a href="#">Backdoor</a></span></p>
            </div>
            <div class="activity">
                <img src="/img/thumbs/mmphs.jpg" alt="avatar mmphs" width="32px" height="32px" />
                <p><span class="person"><a href="#">mmphs</a></span> just arrived at <span class="pub"><a href="#">Backdoor</a></span></p>
            </div>
            <div class="activity">
                <img src="/img/thumbs/joenmaes.jpg" alt="avatar joenmaes" width="32px" height="32px" />
                <p><span class="person"><a href="#">joenmaes</a></span> just drank a <span class="drink"><a href="#">Duvel</a></span> in <span class="pub"><a href="#">Backdoor</a></span></p>
            </div>
            <div class="activity">
                <img src="/img/thumbs/jonckheereM.jpg" alt="avatar jonckheereM" width="32px" height="32px" />
                <p><span class="person"><a href="#">jonckheereM</a></span> just drank a <span class="drink"><a href="#">Malheur</a></span> in <span class="pub"><a href="#">Backdoor</a></span></p>
            </div>
            <div class="activity">
                <img src="/img/thumbs/mmphs.jpg" alt="avatar mmphs" width="32px" height="32px" />
                <p><span class="person"><a href="#">mmphs</a></span> just arrived at <span class="pub"><a href="#">Backdoor</a></span></p>
            </div>
        </div>
        <div id="location">
            <h2>Your location</h2>
            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
            <article>
              <p>Finding your location: <span id="status">Locating...</span></p>
            </article>

            <script>
                //location found
                function success(position) {
                    var s = document.querySelector('#status');
                    if (s.className == 'success') {
                        return;
                    }
                    s.innerHTML = "Found Location!";
                    s.className = 'Success';

                    var mapcanvas = document.createElement('div');
                    mapcanvas.id = 'mapcanvas';
                    mapcanvas.style.height = '200px';
                    mapcanvas.style.width = '360px';

                    document.querySelector('article').appendChild(mapcanvas);

                    //Geolocation
                    var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
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
                        map: map,
                        title:"You are here!"
                    });

                    //Reverse Geocoding (Address Lookup)

                    var geocoder = new google.maps.Geocoder();
                    var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    geocoder.geocode({'latLng': latlng}, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            if (results[0]) {

                                var location = document.createElement('div');
                                location.innerHTML = "<p>Street address: " + results[0].formatted_address + "</p>";
                                document.querySelector('article').appendChild(location);
                            }
                        } else {
                            alert("Geocoder failed due to: " + status);
                        }
                    });

                }
                //error handling
                function error(msg) {
                    var s = document.querySelector('#status');
                    s.innerHTML = typeof msg == 'string' ? msg : "failed";
                    s.className = 'fail';
                }

                //get location
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(success, error, {enableHighAccuracy: true});
                } else {
                    error('not supported');
                }
            </script>
            <h2>Popular pubs in your neighbourhood</h2>
            <ol>
                <li><a href="#">Backdoor</a></li>
                <li><a href="#">Bentos</a></li>
                <li><a href="#">Charlatan</a></li>
                <li><a href="#">De dulle Griet</a></li>
                <li><a href="#">Bar des Amis</a></li>
            </ol>
        </div>
    </div>
</div>
