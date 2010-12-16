<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<div data-role="header" data-position="fixed">
    <h1>pub<span id="lic">lic</span></h1>
    <a href="logout.php" rel="external" data-icon="delete" class="ui-btn-right">Logout</a>
</div><!-- /header -->

<div data-role="content">
    <article>
        <input type="hidden" id="longitude" value="<?php echo $this->variables['longitude']; ?>" />
        <input type="hidden" id="latitude" value="<?php echo $this->variables['latitude']; ?>" />
        <p id="finding">Finding your location: <span id="status">Locating...</span></p>
    </article>

    <ul data-role="listview" data-filter="true" data-theme="c">
        <?php $iPubsI = 1; ?>
<?php $iPubsCount = count($this->variables['iPubs']); ?>
<?php foreach((array) $this->variables['iPubs'] as $iPubs): ?>
<?php
						if(!isset($iPubs['first']) && $iPubsI == 1) $iPubs['first'] = true;
						if(!isset($iPubs['last']) && $iPubsI == $iPubsCount) $iPubs['last'] = true;
						if(isset($iPubs['formElements']) && is_array($iPubs['formElements']))
						{
							foreach($iPubs['formElements'] as $name => $object)
							{
								$iPubs[$name] = $object->parse();
								$iPubs[$name .'Error'] = (method_exists($object, 'getErrors') && $object->getErrors() != '') ? '<span class="formError">'. $object->getErrors() .'</span>' : '';
							}
						}
						?>
        <li><a href="pubDetail.php?id=<?php echo $iPubs['pub_id']; ?>"><?php echo $iPubs['name']; ?></a> <span class="distance">300 meters TODO</span></li>
        <?php $iPubsI++; ?>
<?php endforeach; ?>
    </ul>


</div><!-- /content -->

<div data-role="footer" data-position="fixed">

    <div data-role="navbar" data-grid="c">
        <ul>
            <li><a data-icon="grid" href="dashboard.php" class="ui-btn-active">Activity</a></li>
            <li><a data-icon="grid" href="pubs.php">Pubs</a></li>
            <li><a data-icon="star" href="checkin.php">Check In</a></li>
            <li><a data-icon="gear" href="stuff.php">My stuff</a></li>
        </ul>
    </div><!-- /navbar -->

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
