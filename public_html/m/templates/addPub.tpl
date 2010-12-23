<div data-role="header" data-theme="d" data-position="inline">
    <h1>Dialog</h1>

</div>

<div data-role="content" data-theme="c">
    <h1>Add Pub!</h1>
    <form action="{$formaction}" method="post">
        
        <div data-role="fieldcontain">
            <label for="pubname">Pub name:</label>
            <input type="text" name="pubname" id="pubname" value="{$pubname|htmlentities}"  />
            <span class="error" id="msgFault">{$msgFault|htmlentities}</span>
            <p>Location: near <span class="loc">Unknown</span></p>
        </div>
        <input type="submit" data-theme="b" id="btnAdd" name="btnAdd" value="Add Pub"/>
        <input type="hidden" id="longitude" value="{$longitude}" />
        <input type="hidden" id="latitude" value="{$latitude}" />
    </form>
</div>

<script>
    var longitude = {$longitude};
    var latitude = {$latitude};

    //Reverse Geocoding (Address Lookup)
    var geocoder = new google.maps.Geocoder();
    
    var latlng = new google.maps.LatLng(latitude, longitude);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                document.querySelector('.loc').innerHTML = results[2].formatted_address;
            }
        } else {
            alert("Geocoder failed due to: " + status);
        }
    });
</script>