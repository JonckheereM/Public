<ul data-role="listview" data-filter="true" data-theme="c">
    {iteration:drinks}
    <li><a href="drink.php?id={$drinks.drink_id}">{$drinks.name}</a></li>
    {/iteration:drinks}
</ul>
