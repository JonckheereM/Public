<div id="quick-menu" class="fluid">
    <div class="container">
         <ul id="subnavigation">
            <li><a href="dashboard.php">Me</a></li>
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

        <div id="dashAccounts">
            <h3>Your Linked Accounts</h3>
            <div class="fb">
                <img src="img/fbconnect.png" alt="Facebook"/><br/>
                {$fbstatus}<br/>
                {option:facebook}{$facebook}{/option:facebook}<br/><br/>
            </div>

            <div class="twitter">
                <img src="img/twitter.png" alt="Twitter"/><br/>
                {$twitterstatus}<br/>
                {option:twitter}{$twitter}{/option:twitter}<br/><br/>
            </div>
        </div>

        <div id="dashSettings">
            <h3>Your Account Info <a href="#" style="font-size:10px;">change</a></h3>
            <img src="https://graph.facebook.com/{$fbu}/picture" alt="profilepicture"><br/><br/>
            Username: {$uname}<br/>
            First name: {$firstname}<br/>
            Last name: {$lastname}<br/>
            Email: {$email}<br/>

            <!--Gender: {$gender}<br/>
            Weight: {$weight}<br/>
            Birth date: {$birth}<br/>-->
        </div>

        <div id="dashPrivacy">
            <h3>Your Contact Information</h3>

            Let my <b>friends</b> see my:<br/>
            <input type="checkbox" id="showEmail" value="doEmail" checked/> Email address<br/>
        </div>

        <div id="dashEmail">
            <h3>Email Settings</h3>

            Send me an email when:<br/>
            <input type="checkbox" id="sendEmail" value="doSendEmail" checked/> Somebody adds me as friend<br/>
        </div>

    </div>
</div>

