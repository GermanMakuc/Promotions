<script type="text/javascript">
	function Initialize()
	{
		if (typeof CharacterTransfer != "undefined")
		{
			CharacterTransfer.Initialize({$first_realm.id});
			CharacterTransfer.LANG_SELECT_CHAR = '{$cta_lang.SELECT_CHAR}';
		}
		else
		{
			setTimeout(Initialize, 100);
		}
	}

	$(document).ready(function()
	{
		Initialize();
	});
</script>
<section id="promotion">
	<div id="cta_description">{$cta_lang.DESCRIPTION}</div>
    
    <div id="cta_body">
    	
        <div class="">
        <form onsubmit="CharacterTransfer.Submit(); return false;">
            <div class="cta_row">
                <label>{$cta_lang.REALM}:</label>
            </div>
        	<div class="cta_row">
                <select name="realm" onchange="return CharacterTransfer.RealmChange(this);">
                    {foreach from=$realms key=k item=realm}
                        <option value="{$realm.id}">{$realm.name}</option>
                    {/foreach}
                </select>
          	</div>
            <div class="cta_row">
                <label>{$cta_lang.CHARACTER}:</label>
            </div>
            {foreach from=$realms key=k item=realm}
            <div class="cta_row" {if $realm.id != $first_realm.id}style="display: none;"{else}id="cta_visible_char_select"{/if}>
                <select name="characters_{$realm.id}" id="cta_char_select_{$realm.id}">
                    <option disabled="disabled" selected="selected">{$cta_lang.PLS_SELECT}</option>
                    {if $realm.characters}
                        {foreach from=$realm.characters key=k2 item=char}
                            {if $char.level < 80}
                                <option value="{$char.name}">{$char.name} - {$char.level} Nivel</option>
                            {/if}
                        {/foreach}
                  	{/if}
                </select>
          	</div>
            {/foreach}
             <div class="cta_row">
                    <input type="submit" value="{$cta_lang.TRANSFER}" />
                </div>
                 </form>
        </div>
        
    </div>
</section>
