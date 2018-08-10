<?php
/*if(isset($puesto)){
    echo "<h2>Entrega diaria para el puesto <span class='muted'>$puesto.</span></h2>";
    echo "<h3>Día: <span class='muted'>".date_conv($fecha)."</span></h3>";
}
else{*/
    echo "<h2><span class='muted'>Ficha final</span> del proveedor <b>$nombre_prov.</b></h2>";
//}
?>
<br/>
<p><?php echo Html::anchor('javascript:window.print()', '<span class="glyphicon glyphicon-print"></span> Imprimir ficha final', array('class' => 'btn btn-info','id'=>'print-deliverynote')); ?></p>
<?php if ($entregas): ?>
    <h3 class="print"><u>Historial de entregas del cliente</u></h3>
    <p class="print">Número total de entregas realizadas: <b><?php echo count($entregas) ?></b> durante toda la campaña.</p>
    <table class="table table-striped print">
	    <thead>
		    <tr>
                <th>Fecha entrega</th>
                <th>Núm. Albarán</th>
                <th>Variedad</th>
                <th class="gris">Tamaño</th>
                <th>Total Kg</th>
                <th>Porcentajes</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
<?php
$total_variedades = array();

foreach ($entregas as $item):?>
    <tr>
			<td><?php echo date_conv($item->fecha); ?></td>
            <td><?php echo Model_Albaran::find($item->albaran)->get('idalbaran'); ?></td>
			<td><?php echo Model_Variedad::find($item->variedad)->get('nombre');?></td>
            <td class="gris"><?php echo $item->tam; ?></td>
			<td><strong><?php echo $item->total;
                if(isset($total_variedades[$item->variedad])) {
                    $total_variedades[$item->variedad] += $item->total;
                }else{
                    $total_variedades[$item->variedad] = $item->total;
                }
                ?></strong></td>
            <td><?php echo get_percents($item); ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('entrega/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle', array('class' => 'btn btn-default')); ?>
                        <?php echo Html::anchor('entrega/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-success')); ?>
                        <?php echo Html::anchor('entrega/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de esto?')")); ?>
                    </div>
				</div>
			</td>
		</tr>
<?php endforeach;?>
        </tbody>
</table>

    <br/>
    <br/>
    <h3 class="print"><u>Resumen de kg. entregados por variedad de aceituna</u></h3>
<table class="table table-striped print">
    <thead>
    <tr>
        <th>Variedad</th>
        <th>Total Kg</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $sumakg = 0;
        foreach ($total_variedades as $v => $value):?>
        <tr>
            <td><?php echo Model_Variedad::find($v)->get('nombre'); ?></td>
            <td><?php echo $value; $sumakg += $value; ?> Kg.</td>
        </tr>
    <?php endforeach;?>
    </tbody>
    </table>
    <!--<p>En total suman: <?php /*echo $sumakg;*/ ?> Kg.</p>-->
    <br/>
    <h3 class="print"><u>Listado de anticipos entregados</u></h3>
    <p class="print">Número total de anticipos recogidos: <b><?php echo count($anticipos) ?></b> durante toda la campaña.</p>
    <?php if(count($anticipos)>0):?>
    <table class="table table-striped print">
        <thead>
        <tr>
            <th>Fecha</th>
            <th>Núm. cheque</th>
            <th>Banco</th>
            <th>Cuantía</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $suma = 0;
        foreach ($anticipos as $a):?>
            <tr>
                <td><?php echo date_conv($a->fecha); ?></td>
                <td><?php echo $a->numcheque; ?></td>
                <td><?php echo Model_Banco::find($a->idbanco)->get('nombre'); ?></td>
                <td><?php echo $a->cuantia; $suma += $a->cuantia;?> &euro;</td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <p class="total print">En total suman: <span class="totaleuros"><?php echo number_format($suma,2); ?> &euro;.</span></p>
    <?php else: ?>
        <p class="print">No se han registrado aún anticipos para este proveedor.</p>
    <?php endif; ?>
    <br/>
<?php else: ?>
<p>No se han registrado aún entregas.</p>

<?php endif; ?><p>
    <?php echo Html::anchor('javascript:window.print()', '<span class="glyphicon glyphicon-print"></span>  Imprimir ficha final', array('class' => 'btn btn-info','id'=>'print-deliverynote')); ?>
</p>
<script type="text/javascript">
    var total = $("p.total");
    $($("h3")[2]).next().append("<br/><br/>").append(total);
</script>