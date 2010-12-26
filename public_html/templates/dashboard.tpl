<div id="quick-menu" class="fluid">
    <div class="container">
        <ul id="subnavigation">
            <li class="active"><a href="dashboard.php">Me</a></li>
            <li><a href="dashboardHistory.php">History</a></li>
            <li><a href="dashboardStats.php">Stats</a></li>
            <li><a href="dashboardFriends.php">Friends</a></li>
        </ul>

        <form action="#" method="get">
            <p>
                <input type="text" id="txt-search" />
                <input type="submit" id="btn-search" value="Search" class="imgreplacement search-button" />
            </p>
        </form>
    </div>
</div>

<div id="content" class="fluid">
    <div class="container">
        <div id="recent-activity">
        <h2><img src="https://graph.facebook.com/{$fbu}/picture" alt="profilepicture" width="50px" height="50px"> Hi, {$uname}! - Ghent</h2>
        <h3>Last seen {$lastDate} at <a href="pubDetail.php?id={$lastPubId}">{$lastPub}</a></h3>

        <h2>Friends' Recent Check-ins and Drinks</h2>
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
</div>
