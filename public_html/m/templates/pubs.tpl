<div data-role="header">
    <h1>pub<span id="lic">lic</span></h1>
    <a href="logout.php" rel="external" data-icon="delete" class="ui-btn-right">Logout</a>

    <div data-role="navbar" data-grid="c">
        <ul>
            <li><a rel="external" data-icon="grid" href="dashboard.php">Activity</a></li>
            <li><a rel="external" data-icon="grid" href="pubs.php" class="ui-btn-active">Pubs</a></li>
            <li><a rel="external" data-icon="star" href="checkin.php">Current Pub</a></li>
        </ul>
    </div><!-- /navbar -->
</div><!-- /header -->

<div data-role="content">
    <article>
        <input type="hidden" id="longitude" value="{$longitude}" />
        <input type="hidden" id="latitude" value="{$latitude}" />
        <p id="finding">Finding your location: <span id="status">Locating...</span></p>
    </article>

    <ul data-role="listview" data-filter="true" data-theme="c">
        {iteration:iPubs}
        <li><a href="pubDetail.php?id={$iPubs.pub_id}" rel="external">{$iPubs.name}</a> <span class="distance">{$iPubs.distance}</span></li>
        {/iteration:iPubs}
    </ul>


</div><!-- /content -->

<div data-role="footer">
    <h4>&#169; pub<span id="lic">lic</span></h4>
</div><!-- /footer -->

<script>
    //location found
    function success(position) {
        
        window.location.href = "http://m.publicapp.tk/pubs.php?lat=" + position.coords.latitude + "&long=" + position.coords.longitude;
        //window.location.href = "http://localhost:8888/Public/public_html/m/pubs.php?lat=" + position.coords.latitude + "&long=" + position.coords.longitude;
    }
    
    //error handling
    function error(msg) {
        var s = document.querySelector('#status');
        s.innerHTML = typeof msg == 'string' ? msg : "failed";
        s.className = 'fail';
    }

    if (document.querySelector('#longitude').value != "" && document.querySelector('#latitude').value != "") {
        document.querySelector('#finding').innerHTML = "";
    }

    //get location
    if (navigator.geolocation && document.querySelector('#longitude').value == "" && document.querySelector('#latitude').value == "") {
        navigator.geolocation.getCurrentPosition(success, error, {enableHighAccuracy: true});
    }
</script>
