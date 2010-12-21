<div data-role="header">
    <h1>pub<span id="lic">lic</span></h1>
    <a href="logout.php" rel="external" data-icon="delete" class="ui-btn-right">Logout</a>

    <div data-role="navbar" data-grid="c">
        <ul>
            <li><a rel="external" data-icon="grid" href="dashboard.php">Activity</a></li>
            <li><a rel="external" data-icon="grid" href="pubs.php">Pubs</a></li>
            <li><a rel="external" data-icon="star" href="checkin.php" class="ui-btn-active">Current Pub</a></li>
        </ul>
    </div><!-- /navbar -->
</div><!-- /header -->

<div data-role="content">
    {option:oCheckIn}
    <div id="pub-information">
        <div id="basic">
            <h3>{$name}</h3>
            <span class="city">Ghent TODO</span>
        </div>

        <div class="people">
            <span class="number">{$people}</span> people
        </div>
        <div class="checkins">
            <span class="number">{$checkins}</span> checkins
        </div>
        <div class="clear"></div>

    </div>
    
    <a href="drinks.php"data-role="button" data-theme="b" rel="external">Add Drink!</a>
    {/option:oCheckIn}
    {option:oNoCheckIn}
    <p>You don't have an active check in.</p>
    {/option:oNoCheckIn}

</div><!-- /content -->

<div data-role="footer">
    <h4>&#169; pub<span id="lic">lic</span></h4>
</div><!-- /footer -->
