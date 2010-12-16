<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<div data-role="header" data-position="fixed">
    <h1>pub<span id="lic">lic</span></h1>
    <a href="logout.php" rel="external" data-icon="delete" class="ui-btn-right">Logout</a>
</div><!-- /header -->

<div data-role="content">


</div><!-- /content -->

<div data-role="footer" data-position="fixed">
    
    <div data-role="navbar" data-grid="c">
        <ul>
            <li><a rel="external" data-icon="grid" href="dashboard.php" class="ui-btn-active">Activity</a></li>
            <li><a rel="external" data-icon="grid" href="pubs.php">Pubs</a></li>
            <li><a rel="external" data-icon="star" href="checkin.php">Check In</a></li>
            <li><a rel="external" data-icon="gear" href="stuff.php">My stuff</a></li>
        </ul>
    </div><!-- /navbar -->

    <h4>&#169; pub<span id="lic">lic</span></h4>
</div><!-- /footer -->
