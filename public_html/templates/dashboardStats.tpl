<div id="quick-menu" class="fluid">
    <div class="container">
        <ul id="subnavigation">
            <li><a href="dashboard.php">Me</a></li>
            <li><a href="dashboardHistory.php">History</a></li>
            <li class="active"><a href="dashboardStats.php">Stats</a></li>
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
        <div id="stats">
        <h2>Stats</h2>
        
        <a href="#" id="tweet">+ Tweet these stats!</a>

        <h3>DAYS OUT DRINKING</h3>
        {$daysActive}

        <h3>NUMBER OF CHECKINS</h3>
        {$checkins}

        <h3>AVG DRINKS PER PUB</h3>
        {$avgDrinks}

        <h3>AVG PUBS WHEN OUT DRINKING</h3>
        {$avgDay}

        <h3>TOP 5 FRIENDS</h3>
        {$topFriends}

        <h3>TOP 5 PUBS</h3>
        {option:oTopPubs}
            <ul>
                {iteration:iTopPubs}
                <li>+ <a href="/pubs/{$iTopPubs.pub_id}">{$iTopPubs.name}</a> <span>{$iTopPubs.count} checkins</span></li>
                {/iteration:iTopPubs}
            </ul>
        {/option:oTopPubs}
        {option:oNoTopPubs}
        <p>No top pubs.</p>
        {/option:oNoTopPubs}
        </div>
    </div>
</div>