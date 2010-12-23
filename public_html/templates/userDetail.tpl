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

<div id="content" class="fluid">
    <div class="container">
        <div id="recent-activity">
             <h2>Recent activity</h2>

            {option:oRecent}
            {iteration:iRecent}
            <div class="activity">
                <img src="https://graph.facebook.com/{$iRecent.fb_uid}/picture" alt="profilepicture" width="32px" height="32px" />
                <p><span class="person"><a href="/user/{$iRecent.user_id}">{$iRecent.username}</a></span> just drank a <span class="drink"><a href="/drinks/{$iRecent.drink_id}">{$iRecent.drinkname}</a></span> in <span class="pub"><a href="/pubs/{$iRecent.pub_id}">{$iRecent.pubname}</a></span></p>
                <p><span class="timespan">{$iRecent.timestamp}</span></p>
            </div>
            {/iteration:iRecent}
            <p class="pager">
                <a href="#">&lt;</a>
                <a href="#">1</a>
                <a href="#">2</a>
                <span class="current">3</span>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">6</a>
                <span>&hellip;</span>
                <a href="#">10</a>
                <a href="#">&gt;</a>
            </p>
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
                <p><a href="#" class="button">Add as friend</a>
                {/option:oAddFriend}
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