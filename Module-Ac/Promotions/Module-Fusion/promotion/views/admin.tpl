
<section class="box big" id="main_slider">
    <h2>
		<img src="{$url}application/themes/admin/images/icons/black16x16/ic_list.png"/>
		Estado de Promociones (<div style="display:inline;" id="promotion_count">{if !$promotions}0{else}{count($promotions)}{/if}</div>)
    </h2>
    
    <span>
		Datos con nombre <b>Desconocido</b> = Cuentas o characters que ya no existen.
	</span>

<ul id="slider_list">
    
        <li>
            <table id="data" class="hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Character</th>
                        <th>Cuenta</th>
                        <th>Estado</th>
                        <th>Ingreso</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    {if $promotions}
                    {foreach from=$promotions item=value}
                    <tr id="{$value.id}">
                        <td>{$value.id}</td>
                        <td>{$value.guid}</td>
                        <td>{$value.account}</td>
                        {if $value.entregado == 1}
                        <td>Entregado</td>
                        {else}
                        <td>Espera</td>
                        {/if}
                        <td>{$value.ingreso}</td>
                        <td>
                            <a href="javascript:void(0)" onClick="Slider.remove({$value.id}, {$firstRealm}, this)" data-tip="Delete"><img src="{$url}application/themes/admin/images/icons/black16x16/ic_minus.png" /></a>
                        </td>
                    </tr>
                    {/foreach}
                    {/if}
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Character</th>
                        <th>Cuenta</th>
                        <th>Estado</th>
                        <th>Ingreso</th>
                        <th>Acción</th>
                    </tr>
                </tfoot>
            </table>
        </li>
</ul>
</section>

<script>
    $(document).ready(function() {
    $('#data').DataTable({
        "pagingType": "full_numbers"
    });
} );
</script>