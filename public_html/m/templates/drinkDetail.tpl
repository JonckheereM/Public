<div data-role="header">
    <a href="drinks.php" rel="external" data-icon="arrow-l">Back</a>
    <h1>pub<span id="lic">lic</span></h1>
    <a href="logout.php" rel="external" data-icon="delete" class="ui-btn-right">Logout</a>
</div><!-- /header -->

<div data-role="content">
    <div id="drink-information">
        <script src="http://www.google.com/jsapi?key=ABQIAAAAjClSPIOxNBGxBX4-wq0z2RQdIpNK-FIIU0bQIEsmC2XAZxl40hRSuIEeLYEgih5Oae8K5Pewvdhqfg" type="text/javascript"></script>
        <script type="text/javascript">

            var imageQuery =  "{$name} beverage";

            google.load('search', '1');
            function searchComplete(searcher) {
                if (searcher.results && searcher.results.length > 0) {
                    var contentDiv = document.getElementById('beerImage');
                    contentDiv.innerHTML = '';
                    var results = searcher.results;
                    for (var i = 0; i < 1; i++) {
                        var result = results[i];
                        var newImg = document.createElement('img');
                        newImg.src = result.tbUrl;
                        newImg.width = 85;
                        newImg.height = 70;
                        contentDiv.appendChild(newImg);
                    }
                }
            }

            function OnLoad() {
                var imageSearch = new google.search.ImageSearch();
                imageSearch.setRestriction(google.search.ImageSearch.RESTRICT_IMAGETYPE, google.search.ImageSearch.IMAGETYPE_PHOTO);
                imageSearch.setSearchCompleteCallback(this, searchComplete, [imageSearch]);
                imageSearch.execute(imageQuery);
            }
            google.setOnLoadCallback(OnLoad);

        </script>
        <p id="beerImage">Loading ...</p>
        <h3>{$name}</h3>
        <p>ABV: <span class="abv">{$abv}</span></p>
    </div>

    <form action="{$formaction}" method="post">
        <input type="hidden" value="{$drink_id}" id="drink_id" name="drink_id">
        <input type="submit" data-theme="b" id="btnAddDrink" name="btnAddDrink" value="Add Drink!"/>
    </form>
    <div id="recent-activity"
         <h4>Recent activity</h4>
        {option:oRecent}
        {iteration:iRecent}
        <div class="activity">
            <img src="../img/thumbs/{$iRecent.username}.jpg" alt="avatar mmphs" width="32px" height="32px" />
            <p><span class="person"><a href="userDetail.php?id={$iRecent.user_id}" rel="external">{$iRecent.username}</a></span> just drank a <span class="drink"><a href="drinkDetail.php?id={$iRecent.pub_id}" rel="external">{$name}</a></span> in <span class="pub"><a href="pubDetail.php?id={$iRecent.pub_id}" rel="external">{$iRecent.pubname}</a></span>
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