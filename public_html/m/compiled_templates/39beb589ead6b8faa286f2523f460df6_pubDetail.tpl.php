<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<div data-role="header" data-position="fixed">
    <a href="pubs.php" rel="external" data-icon="arrow-l">Back</a>
    <h1>pub<span id="lic">lic</span></h1>
    <a href="logout.php" rel="external" data-icon="delete" class="ui-btn-right">Logout</a>
</div><!-- /header -->

<div data-role="content">
    <div id="pub-information">
        <div id="basic">
            <h3><?php echo $this->variables['name']; ?></h3>
            <span class="city">Ghent TODO</span>
        </div>

        <div>
            <span class="people"><span class="number"><?php echo $this->variables['people']; ?></span> people</span>
        </div>
        <div>
            <span class="checkins"><span class="number"><?php echo $this->variables['checkins']; ?></span> checkins</span>
        </div>

    </div>

    <a href="#" data-theme="b" data-role="button">Check In</a>

</div><!-- /content -->

<div data-role="footer" data-position="fixed">
    <h4>&#169; pub<span id="lic">lic</span></h4>
</div><!-- /footer -->
