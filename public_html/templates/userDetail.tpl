<div id="quick-menu" class="fluid">
    <div class="container">
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
<style type="text/css">
ul.simplePagerNav li{
    display:block;
    floaT: left;
    padding: 3px;
    margin-bottom: 10px;
    font-family: georgia;
}
ul.simplePagerNav li a{
    color: #333;
    text-decoration: none;
}
li.currentPage {
	background: red;
        background: #gray;
}
ul.simplePagerNav li.currentPage a {
	color: #fff;
}
table.pageme {
    border-collapse: collapse;
    border: 1px solid #ccc;
}
table.pageme td {
    border-collapse: collapse;
    border: 1px solid #ccc;
}
ul.paging  li.sticky {
	background-color: red !important;
	display: block !important
}
</style>

<div id="content" class="fluid">
    <div class="container">
        <div id="recent-activity">
             <h2>Recent activity</h2>

            {option:oRecent}      
            <ul class="paging">
                {iteration:iRecent}
                     <li>
                        <div class="activity">
                            <img src="https://graph.facebook.com/{$iRecent.fb_uid}/picture" alt="profilepicture" width="32px" height="32px" />
                            <p><span class="person"><a href="/user/{$iRecent.user_id}">{$iRecent.username}</a></span> just drank a <span class="drink"><a href="/drinks/{$iRecent.drink_id}">{$iRecent.drinkname}</a></span> in <span class="pub"><a href="/pubs/{$iRecent.pub_id}">{$iRecent.pubname}</a></span></p>
                            <p><span class="timespan">{$iRecent.timestamp}</span></p>
                        </div>
                    </li>
                {/iteration:iRecent}
            </ul>
            {/option:oRecent}
            {option:oNoRecent}
            <p>No recent activities.</p>
            {/option:oNoRecent}
        </div>
        <div id="user-detail">
            <h2>User detail</h2>
            <div id="user-information">
                <p><img src="https://graph.facebook.com/{$fb_uid}/picture" alt="profilepicture" width="135px" height="104px" /></p>
                <h3>{$name}</h3>
                {option:oAddFriend}
                <p><a href="/users/{$user_id}/follow" class="button">Follow</a>
                {/option:oAddFriend}
                {option:oDeleteFriend}
                <p><a href="/users/{$user_id}/unfollow" class="button">Unfollow</a>
                {/option:oDeleteFriend}
            </div>
            <h2>Top pubs</h2>
            {option:oTopPubs}
            <ol>

                {iteration:iTopPubs}
                <li><a href="/pubs/{$iTopPubs.pub_id}">{$iTopPubs.name}</a> <span>{$iTopPubs.count} checkins</span></li>
                {/iteration:iTopPubs}
            </ol>
            {/option:oTopPubs}
            {option:oNoTopPubs}
            <p>No top pubs.</p>
            {/option:oNoTopPubs}
        </div>

    </div>
</div>