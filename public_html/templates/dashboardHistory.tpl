<div id="quick-menu" class="fluid">
    <div class="container">
        <ul id="subnavigation">
            <li><a href="dashboard.php">Me</a></li>
            <li class="active"><a href="dashboardHistory.php">History</a></li>
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

<script src="https://www.google.com/jsapi?key=ABQIAAAAjClSPIOxNBGxBX4-wq0z2RR75ioQX0VOMPX_acNpIAmoM0SKwBTs1bZPV2MDQ-Ye-OpLfVC0J89Isw" type="text/javascript"></script>
<script type="text/javascript">
  google.load("jquery", "1");
</script>
<script type="text/javascript" src="/js/quickpager.jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("ul.paging").quickPager();
});
</script>

<div id="content" class="fluid">
    <div class="container">
        <div id="recent-activity">
        <h2>Check-in History</h2>
        <h3>Here's a quick recap of all the places you've been.</h3>

        <ul class="paging">
        {iteration:iRecent}
        <li>
        <div class="activity">
            <img src="https://graph.facebook.com/{$iRecent.fb_uid}/picture" alt="profilepicture" width="32px" height="32px" />
            {option:iRecent.drink_id}<p><span class="person"><a href="#">{$iRecent.username}</a></span> just drank a <span class="drink"><a href="drinkDetail.php?id={$iRecent.drink_id}">{$iRecent.drinkname}</a></span> in <span class="pub"><a href="pubDetail.php?id={$iRecent.pub_id}">{$iRecent.pubname}</a></span></p>{/option:iRecent.drink_id}
            {option:iRecent.checkin_id}<p><span class="person"><a href="#">{$iRecent.username}</a></span> just arrived at <span class="pub"><a href="pubDetail.php?id={$iRecent.pub_id}">Backdoor</a></span></p>{/option:iRecent.checkin_id}
            <p><span class="timespan">{$iRecent.timestamp}</span></p>
        </div>
        </li>
        {/iteration:iRecent}
        </ul>
        </div>
    </div>
</div>
