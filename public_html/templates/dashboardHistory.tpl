<div id="quick-menu" class="fluid">
    <div class="container">
        <ul>
            <li><a href="dashboard.php">Me | </a></li>
            <li><a href="dashboardHistory.php">History | </a></li>
            <!--<li><a href="dashboardStats.php">Stats | </a></li>-->
            <li><a href="dashboardFriends.php">Friends | </a></li>
        </ul>
    </div>
</div>

<div id="content" class="fluid">
    <div class="container">

        <h2>Check-in History</h2>
        <h3>Here's a quick recap of all the places you've been.</h3>

        {iteration:iRecent}
        <div class="activity">
            <img src="https://graph.facebook.com/{$iRecent.fb_uid}/picture" alt="profilepicture" width="32px" height="32px" />
            {option:iRecent.drink_id}<p><span class="person"><a href="#">{$iRecent.username}</a></span> just drank a <span class="drink"><a href="drinkDetail.php?id={$iRecent.drink_id}">{$iRecent.drinkname}</a></span> in <span class="pub"><a href="pubDetail.php?id={$iRecent.pub_id}">{$iRecent.pubname}</a></span></p>{/option:iRecent.drink_id}
            {option:iRecent.checkin_id}<p><span class="person"><a href="#">{$iRecent.username}</a></span> just arrived at <span class="pub"><a href="pubDetail.php?id={$iRecent.pub_id}">Backdoor</a></span></p>{/option:iRecent.checkin_id}
            <p><span class="timespan">{$iRecent.timestamp}</span></p>
        </div>
        {/iteration:iRecent}
    </div>
</div>
