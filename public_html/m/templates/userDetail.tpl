<div data-role="header">
    <h1>pub<span id="lic">lic</span></h1>
    <a href="logout.php" rel="external" data-icon="delete" class="ui-btn-right">Logout</a>

    <div data-role="navbar" data-grid="c">
        <ul>
            <li><a rel="external" data-icon="star" href="dashboard.php">Activity</a></li>
            <li><a rel="external" data-icon="grid" href="pubs.php">Pubs</a></li>
            <li><a rel="external" data-icon="check" href="checkin.php">Current Pub</a></li>
        </ul>
    </div><!-- /navbar -->
</div><!-- /header -->

<div data-role="content">
    <div id="user-information">
        <img src="https://graph.facebook.com/{$fb_uid}/picture" alt="avatar {$username}" width="85px" height="70px" />
        <h3>{$username}</h3>
    </div>
    <div id="recent-activity"
         <h4>Recent activity</h4>
        {option:oRecent}
        {iteration:iRecent}
        <div class="activity">
            <img src="https://graph.facebook.com/{$iRecent.fb_uid}/picture" alt="profilepicture" width="32px" height="32px" />
            <p><span class="person"><a href="userDetail.php?id={$iRecent.user_id}">{$iRecent.username}</a></span> just drank a <span class="drink"><a href="drinkDetail.php?id={$iRecent.drink_id}">{$iRecent.drinkname}</a></span> in <span class="pub"><a href="drinkDetail.php?id={$iRecent.pub_id}">{$iRecent.pubname}</a></span>
            <br /><span class="timespan">{$iRecent.timestamp}</span></p>
        </div>
        {/iteration:iRecent}
        {/option:oRecent}
        {option:oNoRecent}
        <p>No recent activities.</p>
        {/option:oNoRecent}
    </div>
</div><!-- /content -->

<div data-role="footer">
    <h4>&#169; pub<span id="lic">lic</span></h4>
</div><!-- /footer -->