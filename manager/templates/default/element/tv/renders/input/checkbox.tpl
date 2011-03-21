<div id="tv{$tv->id}-cb"></div>

<script type="text/javascript">
// <![CDATA[
{literal}
MODx.load({
{/literal}
    xtype: 'checkboxgroup'
    ,id: 'tv{$tv->id}'
    ,vertical: true
    ,columns: 1
    ,renderTo: 'tv{$tv->id}-cb'
    ,name: 'tv-{$tv->id}'
    ,width: 500
    ,hideMode: 'offsets'

    ,items: [{foreach from=$opts item=item key=k name=cbs}
    {literal}{{/literal}
        name: 'tv{$tv->id}[]'
        ,id: 'tv{$tv->id}-{$k}'
        ,boxLabel: '{$item.text|escape:"javascript"}'
        ,checked: {if $item.checked}true{else}false{/if}
        ,inputValue: {if $item.value !== 0 AND $item.value !== null}'{$item.value|escape:"javascript"}'{else}0{/if}
        ,value: {if $item.value !== 0 AND $item.value !== null}'{$item.value|escape:"javascript"}'{else}0{/if}
    {literal}}{/literal}{if NOT $smarty.foreach.cbs.last},{/if}
    {/foreach}]
{literal}}{/literal});
{foreach from=$opts item=item key=k name=cbs}
Ext.getCmp('tv{$tv->id}-{$k}').on('check',MODx.fireResourceFormChange);
{/foreach}

Ext.get('tvdef{$tv->id}').dom.value = "{$cbdefaults}";
// ]]>
</script>