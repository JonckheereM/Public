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

<script src="https://www.google.com/jsapi?key=ABQIAAAAjClSPIOxNBGxBX4-wq0z2RR75ioQX0VOMPX_acNpIAmoM0SKwBTs1bZPV2MDQ-Ye-OpLfVC0J89Isw" type="text/javascript"></script>
<script type="text/javascript">
  google.load("jquery", "1");
</script>
<script type="text/javascript" src="/js/quickpager.jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("ul.paging").quickPager();
});
</script>

<div id="content" class="fluid">
    <div class="container">
        <div id="recent-activity">
             <h2>Recent activity</h2>
            {option:oRecent}
             <ul class="paging">
            {iteration:iRecent}
            <li>
            <div class="activity">
                <img src="https://graph.facebook.com/{$iRecent.fb_uid}/picture" alt="profilepicture" width="32px" height="32px" />
                <p><span class="person"><a href="users/{$iRecent.user_id}">{$iRecent.username}</a></span> just arrived at <span class="pub"><a href="pubs/{$iRecent.pub_id}">{$iRecent.pubname}</a></span></p>
                <p><span class="timespan">{$iRecent.timestamp}</span></p>
            </div>
            </li>
            {/iteration:iRecent}
            </ul>
            {/option:oRecent}
            {option:oNoRecent}
            <p>No recent activities.</p>
            {/option:oNoRecent}
        </div>
        <div id="pub-detail">
            <h2>Pub detail</h2>


            <div id="pub-information">
                <div id="basic">
                    <h3>{$name}</h3>
                    <span class="city">Unknown</span>
                </div>
                
                <div>
                    <span class="people"><span class="number">{$people}</span> people</span>
                </div>
                <div>
                    <span class="checkins"><span class="number">{$checkins}</span> checkins</span>
                </div>

            </div>


            <div id="map">
                <input type="hidden" id="longitude" value="{$longitude}" />
                <input type="hidden" id="latitude" value="{$latitude}" />
                <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
                <article>
                </article>

                <script>
                    var longitude = document.querySelector('#longitude').value;
                    var latitude = document.querySelector('#latitude').value;

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
                        map: map,
                        title:"You are here!"
                    });

                    //Reverse Geocoding (Address Lookup)
                    var geocoder = new google.maps.Geocoder();
                    var latlng = new google.maps.LatLng(latitude, longitude);
                    geocoder.geocode({'latLng': latlng}, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            if (results[0]) {
                                document.querySelector('.city').innerHTML = results[2].formatted_address;
                            }
                        } else {
                            alert("Geocoder failed due to: " + status);
                        }
                    });
                </script>
            </div>
            <h2>Top visitors</h2>
            {option:oTopCheckins}
            <ol>
                {iteration:iTopCheckins}
                    <li><a href="#">{$iTopCheckins.username}</a> <span>{$iTopCheckins.count} checkins</span></li>
                {/iteration:iTopCheckins}
            </ol>
            {/option:oTopCheckins}
            {option:oNoTopCheckins}
            <p>No top visitors.</p>
            {/option:oNoTopCheckins}
        </div>

    </div>
</div>