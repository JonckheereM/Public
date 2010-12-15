<div id="quick-menu" class="fluid">
    <div class="container">
        <form action="#" method="get">
            <p>
                <input type="text" id="txt-search" />
                <input type="submit" id="btn-search" value="Search" class="imgreplacement search-button" />
            </p>
        </form>
    </div>
</div>

<div id="content" class="fluid">
    <div class="container">
        <h2>List of pubs</h2>
        <div id="map">
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
                    mapcanvas.style.height = '450px';
                    mapcanvas.style.width = '500px';

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
            
        </div>
        <div id="list">
            <div class="pub">
                <img src="/img/dev/map-icon.png" alt="map icon A" width="22px" height="36px" />
                <h3><a href="#">Backdoor</a></h3>
                <p>
                    <span class="people"><span class="number">16</span> people</span>
                    <span class="checkins"><span class="number">23</span> checkins</span>
                </p>
            </div>
            <div class="pub">
                <img src="/img/dev/map-icon.png" alt="map icon A" width="22px" height="36px" />
                <h3><a href="#">Backdoor</a></h3>
                <p>
                    <span class="people"><span class="number">16</span> people</span>
                    <span class="checkins"><span class="number">23</span> checkins</span>
                </p>
            </div>
            <div class="pub">
                <img src="/img/dev/map-icon.png" alt="map icon A" width="22px" height="36px" />
                <h3><a href="#">Backdoor</a></h3>
                <p>
                    <span class="people"><span class="number">16</span> people</span>
                    <span class="checkins"><span class="number">23</span> checkins</span>
                </p>
            </div>
            <div class="pub">
                <img src="/img/dev/map-icon.png" alt="map icon A" width="22px" height="36px" />
                <h3><a href="#">Backdoor</a></h3>
                <p>
                    <span class="people"><span class="number">16</span> people</span>
                    <span class="checkins"><span class="number">23</span> checkins</span>
                </p>
            </div>
            <div class="pub">
                <img src="/img/dev/map-icon.png" alt="map icon A" width="22px" height="36px" />
                <h3><a href="#">Backdoor</a></h3>
                <p>
                    <span class="people"><span class="number">16</span> people</span>
                    <span class="checkins"><span class="number">23</span> checkins</span>
                </p>
            </div>
            <div class="pub">
                <img src="/img/dev/map-icon.png" alt="map icon A" width="22px" height="36px" />
                <h3><a href="#">Backdoor</a></h3>
                <p>
                    <span class="people"><span class="number">16</span> people</span>
                    <span class="checkins"><span class="number">23</span> checkins</span>
                </p>
            </div>
            <div class="pub">
                <img src="/img/dev/map-icon.png" alt="map icon A" width="22px" height="36px" />
                <h3><a href="#">Backdoor</a></h3>
                <p>
                    <span class="people"><span class="number">16</span> people</span>
                    <span class="checkins"><span class="number">23</span> checkins</span>
                </p>
            </div>
            <div class="pub">
                <img src="/img/dev/map-icon.png" alt="map icon A" width="22px" height="36px" />
                <h3><a href="#">Backdoor</a></h3>
                <p>
                    <span class="people"><span class="number">16</span> people</span>
                    <span class="checkins"><span class="number">23</span> checkins</span>
                </p>
            </div>
            <p class="pager">
                <a href="#">&lt;</a>
                <a href="#">1</a>
                <a href="#">2</a>
                <span class="current">3</span>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">6</a>
                <span>&hellip;</span>
                <a href="#">10</a>
                <a href="#">&gt;</a>
            </p>
        </div>
    </div>
</div>