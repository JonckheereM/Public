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

        <h3>Your Linked Accounts</h3>
        <img src="img/fbconnect.png" alt="Facebook"/><br/>
        {$fbstatus}<br/>
        {option:facebook}{$facebook}{/option:facebook}<br/><br/>

        <img src="img/twitter.png" alt="Twitter"/><br/>
        {$twitterstatus}<br/>
        {option:twitter}{$twitter}{/option:twitter}<br/><br/>

        <h3>Your Account Info</h3>
        <img src="https://graph.facebook.com/{$fbu}/picture" alt="profilepicture" width="50px" height="50px"><br/>
        Username: {$uname}<br/>
        First name: {$firstname}<br/>
        Last name: {$lastname}<br/>
        Email: {$email}<br/>

        <!--Gender: {$gender}<br/>
        Weight: {$weight}<br/>
        Birth date: {$birth}<br/>-->

    </div>
</div>

