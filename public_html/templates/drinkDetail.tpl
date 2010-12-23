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
                <p><span class="person"><a href="/user/{$iRecent.user_id}">{$iRecent.username}</a></span> just drank a <span class="drink"><a href="/drinks/{$iRecent.pub_id}">{$name}</a></span> in <span class="pub"><a href="/pubs/{$iRecent.pub_id}">{$iRecent.pubname}</a></span></p>
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
        <div id="drink-detail">
            <h2>Drink detail</h2>
            <div id="drink-information">
                <input type="hidden" id="name" value="{$name}" />
                <script src="http://www.google.com/jsapi?key=ABQIAAAAjClSPIOxNBGxBX4-wq0z2RQdIpNK-FIIU0bQIEsmC2XAZxl40hRSuIEeLYEgih5Oae8K5Pewvdhqfg" type="text/javascript"></script>
                <script type="text/javascript">

                    var imageQuery = document.querySelector('#name').value;
                    imageQuery +=  " beverage";

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
                                newImg.width = 135;
                                newImg.height = 104;
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
            <h2>Top drinkers</h2>
            {option:oTopDrinkers}
            <ol>

                {iteration:iTopDrinkers}
                <li><a href="/users/{$iTopDrinkers.user_id}">{$iTopDrinkers.username}</a> <span>{$iTopDrinkers.count} drinks</span></li>
                {/iteration:iTopDrinkers}
            </ol>
            {/option:oTopDrinkers}
            {option:oNoTopDrinkers}
            <p>No top drinkers.</p>
            {/option:oNoTopDrinkers}
        </div>

    </div>
</div>