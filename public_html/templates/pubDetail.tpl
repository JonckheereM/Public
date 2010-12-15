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
        <div id="recent-activity"
             <h2>Recent activity</h2>
            {option:oRecent}
            {iteration:iRecent}
            <div class="activity">
                <img src="/img/thumbs/{$iRecent.username}.jpg" alt="avatar mmphs" width="32px" height="32px" />
                <p><span class="person"><a href="/userDetail.php?id={$iRecent.user_id}">{$iRecent.username}</a></span> just arrived at <span class="pub"><a href="pubDetail.php?id={$iRecent.pub_id}">{$iRecent.pubname}</a></span></p>
                <p><span class="timespan">{$iRecent.timestamp}</span></p>
            </div>
            {/iteration:iRecent} 
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
                    <span class="city">Ghent</span>
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
                    var latlng = new google.maps.LatLng(longitude, latitude);
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