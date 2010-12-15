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
                <img src="/img/thumbs/{$iRecent.username}.jpg" alt="avatar mmphs" width="32px" height="32px" />
                <p><span class="person"><a href="userDetail.php?id={$iRecent.user_id}">{$iRecent.username}</a></span> just drank a <span class="drink"><a href="drinkDetail.php?id={$iRecent.pub_id}">{$name}</a></span> in <span class="pub"><a href="pubDetail.php?id={$iRecent.pub_id}">{$iRecent.pubname}</a></span></p>
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
                <li><a href="userDetail.php?id={$iTopDrinkers.user_id}">{$iTopDrinkers.username}</a> <span>{$iTopDrinkers.count} drinks</span></li>
                {/iteration:iTopDrinkers}
            </ol>
            {/option:oTopDrinkers}
            {option:oNoTopDrinkers}
            <p>No top drinkers.</p>
            {/option:oNoTopDrinkers}
        </div>

    </div>
</div>