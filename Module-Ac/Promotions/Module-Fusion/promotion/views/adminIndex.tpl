
<section class="box big" id="main_slider">
    <h2>
		<img src="{$url}application/themes/admin/images/icons/black16x16/ic_list.png"/>
		Selecciona el Reino
    </h2>

<ul id="slider_list">
    <li>
    <form action="admin/viewRealm" method="POST">
        <select name="realmId" id="realmId">
            {foreach from=$realms key=k item=realm}
                <option value="{$realm.id}">{$realm.id} - {$realm.name}</option>
            {/foreach}
            <input type="hidden" name="{$tokenName}" value="{$tokenValue}">
        </select>
        <input type="submit" value="Seleccionar">
    </form>
    </li>
</ul>
</section>