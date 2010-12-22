<style type="text/css">
  #footer {
    position:absolute;
    bottom:0;
}
</style>
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
        <div id="overview-map">
            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
            <article>
                <p id="finding">Finding your location: <span id="status">Locating...</span></p>
            </article>

            <script>
                var longitude = {$longitude};
                var latitude = {$latitude};
                
                //location found
                function success(position) {
                    window.location.href = "http://publicapp.tk/pubs.php?lat=" + position.coords.latitude + "&long=" + position.coords.longitude;
                    //window.location.href = "http://localhost:8888/Public/public_html/pubs.php?lat=" + position.coords.latitude + "&long=" + position.coords.longitude;
                }
                if(longitude != "" && latitude != ""){
                    document.querySelector('#finding').innerHTML = '';

                    var mapcanvas = document.createElement('div');
                    mapcanvas.id = 'mapcanvas';
                    mapcanvas.style.height = '450px';
                    mapcanvas.style.width = '500px';

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
                        map: map,
                        icon: new google.maps.MarkerImage("http://www.google.com/mapfiles/arrow.png"),
                        shadow: new google.maps.MarkerImage("http://www.google.com/mapfiles/arrowshadow.png"),
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

        </div>
        <div id="list">
            <div class="pub">
                <img src="http://www.google.com/mapfiles/arrow.png" alt="map icon A" width="22px" height="36px" />
                <h3>Your location</h3>
            </div>
            {iteration:iPubs}
            <div class="pub">
                <img src="http://www.google.com/mapfiles/marker{$iPubs.letter}.png" alt="map icon {$iPubs.letter}" width="22px" height="36px" />
                <h3><a href="pubDetail.php?id={$iPubs.pub_id}">{$iPubs.name}</a></h3>
                <p>
                    <span class="people"><span class="number">{$iPubs.people}</span> people</span>
                    <span class="checkins"><span class="number">{$iPubs.checkins}</span> checkins</span>
                </p>
            </div>
            {/iteration:iPubs}

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