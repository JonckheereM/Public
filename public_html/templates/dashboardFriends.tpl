<div id="quick-menu" class="fluid">
    <div class="container">
        <ul id="subnavigation">
            <li><a href="dashboard.php">Me</a></li>
            <li><a href="dashboardHistory.php">History</a></li>
            <li><a href="dashboardStats.php">Stats</a></li>
            <li class="active"><a href="dashboardFriends.php">Friends</a></li>
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

        <h2>Manage Friends</h2>
        <h3>Following</h3>
        {option:oFollowing}
        <ul>
          {iteration:iFollowing}
          <li>
            <img src="https://graph.facebook.com/{$iFollowing.fb_uid}/picture" alt="profilepicture" width="32px" height="32px" />
            <a href="/users/{$iFollowing.user_id}">{$iFollowing.username}</a>
          </li>
          {/iteration:iFollowing}
        </ul>
        {/option:oFollowing}
        {option:oNoFollowing}
        <p>You follow nobody</p>
        {/option:oNoFollowing}
        <h3>Followers</h3>
        {option:oFollowers}
        <ul>
          {iteration:iFollowers}
          <li>
            <img src="https://graph.facebook.com/{$iFollowers.fb_uid}/picture" alt="profilepicture" width="32px" height="32px" />
            <a href="/users/{$iFollowers.user_id}">{$iFollowers.username}</a>
          </li>
          {/iteration:iFollowers}
        </ul>
        {/option:oFollowers}
        {option:oNoFollowers}
        <p>Nobody follows you</p>
        {/option:oNoFollowers}

    </div>
</div>