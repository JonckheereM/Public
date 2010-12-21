<div data-role="header">
    <a href="checkin.php" rel="external" data-icon="arrow-l">Back</a>
    <h1>pub<span id="lic">lic</span></h1>
    <a href="logout.php" rel="external" data-icon="delete" class="ui-btn-right">Logout</a>
</div><!-- /header -->

<div data-role="content">
    <ul data-role="listview" data-filter="true" data-theme="c">
        {iteration:iDrinks}
            <li><a href="drinkDetail.php?id={$iDrinks.drink_id}" rel="external">{$iDrinks.name}</a></li>
        {/iteration:iDrinks}
    </ul>
</div><!-- /content -->

<div data-role="footer">
    <h4>&#169; pub<span id="lic">lic</span></h4>
</div><!-- /footer -->