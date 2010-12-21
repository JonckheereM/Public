<div data-role="header">
    <h1>pub<span id="lic">lic</span></h1>
    <a href="logout.php" rel="external" data-icon="delete" class="ui-btn-right">Logout</a>

    <div data-role="navbar" data-grid="c">
        <ul>
            <li><a rel="external" data-icon="grid" href="dashboard.php" class="ui-btn-active">Activity</a></li>
            <li><a rel="external" data-icon="grid" href="pubs.php">Pubs</a></li>
            <li><a rel="external" data-icon="star" href="checkin.php">Current Pub</a></li>
        </ul>
    </div><!-- /navbar -->
</div><!-- /header -->

<div data-role="content">
    <h4>Recent activity</h4>
    {option:oRecent}
    {iteration:iRecent}
    <div class="activity">
        <img src="/../img/thumbs/{$iRecent.username}.jpg" alt="avatar {$iRecent.username}" width="32px" height="32px" />
        <p>{option:iRecent.drink_id}<span class="person"><a href="#" rel="external">{$iRecent.username}</a></span> just drank a <span class="drink"><a href="drinkDetail.php?id={$iRecent.drink_id}" rel="external">{$iRecent.drinkname}</a></span> in <span class="pub"><a href="pubDetail.php?id={$iRecent.pub_id}" rel="external">{$iRecent.pubname}</a></span>{/option:iRecent.drink_id}
        {option:iRecent.checkin_id}<span class="person"><a href="#" rel="external">{$iRecent.username}</a></span> just arrived at <span class="pub"><a href="pubDetail.php?id={$iRecent.pub_id}" rel="external">{$iRecent.pubname}</a></span>{/option:iRecent.checkin_id}
        <br /><span class="timespan">{$iRecent.timestamp}</span></p>
    </div>
    {/iteration:iRecent}
    {/option:oRecent}
    {option:oNoRecent}
    <p>No recent activities.</p>
    {/option:oNoRecent}

</div><!-- /content -->

<div data-role="footer">
    <h4>&#169; pub<span id="lic">lic</span></h4>
</div><!-- /footer -->
