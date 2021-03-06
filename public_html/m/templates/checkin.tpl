<div data-role="header">
    <h1>pub<span id="lic">lic</span></h1>
    <a href="logout.php" rel="external" data-icon="delete" class="ui-btn-right">Logout</a>

    <div data-role="navbar" data-grid="c">
        <ul>
            <li><a rel="external" data-icon="star" href="dashboard.php">Activity</a></li>
            <li><a rel="external" data-icon="grid" href="pubs.php">Pubs</a></li>
            <li><a rel="external" data-icon="check" href="checkin.php" class="ui-btn-active">Current Pub</a></li>
        </ul>
    </div><!-- /navbar -->
</div><!-- /header -->

<div data-role="content">
    {option:oLegalToDrive}<p id="legalToDrive">It is ok to drive! *</p>{/option:oLegalToDrive}
    {option:oNotLegalToDrive}<p id="notLegalToDrive">It is NOT ok to drive! *</p>{/option:oNotLegalToDrive}
    {option:oNotAbleLegalToDrive}<p id="notAbleLegalToDrive">Please fill in your weight and gender to see if it is legal to drive. *</p>{/option:oNotAbleLegalToDrive}
    {option:oCheckIn}
    <div id="pub-information">
        <div id="basic">
            <h3>{$name}</h3>
            <span class="city">Unknown</span>
        </div>

        <div class="people">
            <span class="number">{$people}</span> people
        </div>
        <div class="checkins">
            <span class="number">{$checkins}</span> checkins
        </div>
        <div class="clear"></div>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
        <script>
            var longitude = {$longitude};
            var latitude = {$latitude};

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

    <a href="drinks.php"data-role="button" data-theme="b" rel="external">Add Drink!</a>

    
    <h4>You have drunk:</h4>


    <ul id="checkinTabs">
        {iteration:iTabs}
        <li>
            <div class="checkinDrink">
                <span class="drinkCount">{$iTabs.count}</span> X
                <span class="drink"><a href="drinkDetail.php?id={$iTabs.drink_id}" rel="external">{$iTabs.name}</a></span>
            </div>
            <div data-role="controlgroup" data-type="horizontal" class="drinkPlusMin">
                <a rel="external" href="checkin.php?drinkid={$iTabs.drink_id}&event=min" title="min" data-inline="true" data-role="button" data-icon="minus" data-iconpos="right"></a>
                <a rel="external" href="checkin.php?drinkid={$iTabs.drink_id}&event=plus" title="plus" data-inline="true" data-role="button" data-icon="plus"></a>
            </div>
            <div class="clear"></div>
        </li>
        {/iteration:iTabs}
    </ul>


    {/option:oCheckIn}
    {option:oNoCheckIn}
    <p>You don't have an active check in.</p>
    {/option:oNoCheckIn}

    <p>* We are not responsible for accidents. This is just an indication.</p>

</div><!-- /content -->

<div data-role="footer">
    <h4>&#169; pub<span id="lic">lic</span></h4>
</div><!-- /footer -->
