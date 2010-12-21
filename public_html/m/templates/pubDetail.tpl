<div data-role="header">
    <a href="pubs.php" rel="external" data-icon="arrow-l">Back</a>
    <h1>pub<span id="lic">lic</span></h1>
    <a href="logout.php" rel="external" data-icon="delete" class="ui-btn-right">Logout</a>
</div><!-- /header -->

<div data-role="content">


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

    <form action="{$formaction}" method="post">
        <input type="hidden" value="{$pub_id}" id="pub_id" name="pub_id">
        <input type="submit" data-theme="b" id="btnCheckIn" name="btnCheckIn" value="Check In!"/>
    </form>
    <div id="recent-activity"
         <h4>Recent activity</h4>
         {option:oRecent}
         {iteration:iRecent}
         <div class="activity">
            <img src="../img/thumbs/{$iRecent.username}.jpg" alt="avatar mmphs" width="32px" height="32px" />
            <p><span class="person"><a href="userDetail.php?id={$iRecent.user_id}" rel="external">{$iRecent.username}</a></span> just arrived at <span class="pub"><a href="pubDetail.php?id={$iRecent.pub_id}" rel="external">{$iRecent.pubname}</a></span>
                <br/><span class="timespan">{$iRecent.timestamp}</span></p>
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
