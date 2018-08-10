<?php
\Fuel\Core\Session::delete('idprov');	
if(isset($puesto)){
    echo "<h2>Entrega diaria para el puesto <span class='muted'>$puesto.</span></h2>";
    echo "<h3>Día: <span class='muted'>".date_conv($fecha)."</span></h3><br/>";
}
else{
    echo "<h2><span class='muted'>Entregas</span> realizadas $titulo </h2>";
    echo '<br/>'.Html::anchor('entrega/create', '<span class="glyphicon glyphicon-plus"></span> Añadir nueva entrega', array('class' => 'btn btn-success'));
}
?>
<br/>
<?php if ($entregas): ?>
    <?php if(isset($puesto)){ ?>
        <h4>Número de entregas registradas hoy: <span class='muted'><?php echo count($entregas); ?></span></h4>
    <?php }else{ ?>
        <h4>Número de entregas registradas en total: <span class='muted'><?php echo count($entregas); ?></span></h4>
    <?php } ?>
    <br/>
	<p><u>ATENCIÓN:</u> este listado no está ordenado por el <i>número de albarán</i>, sino por el <b>número de la entrega</b>. Si ves que no encuentras un albarán concreto, prueba a buscarlo en 
		<?php echo Html::anchor('albaran/list', 'este listado', array('target' => '_blank')); ?>.</p>
    <h3 class="print"><u>Listado detallado de entregas</u></h3>
    <table class="table table-striped print">
	<thead>
		<tr>
			<th>Fecha entrega</th>
            <th>Proveedor</th>
            <th>NIF/CIF</th>
			<th>Núm. Albarán</th>
			<th>Variedad</th>
			<th>Total Kg</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php
$total = array();
foreach ($entregas as $item):
if(Model_Albaran::find('first', array('where' => array('id' => $item->albaran)))){
	$alb = Model_Albaran::find('first', array('where' => array('id' => $item->albaran)));
	$prov = Model_Proveedor::find($alb->get('idproveedor'))->get('nombre');
	$nif = Model_Proveedor::find($alb->get('idproveedor'))->get('nifcif');
}
else{
	$prov = "N/D";
	$nif = "N/D";
}
?>
    <tr>
			<td><?php echo date_conv($item->fecha); ?></td>
            <td><?php echo $prov; ?></td>
            <td><?php echo $nif; ?></td>
            <td><?php 
				if(Model_Albaran::find($item->albaran)){
					echo Model_Albaran::find($item->albaran)->get('idalbaran');
				}
				else{
					echo "N/D";
				}
				 ?></td>
			<td><?php $v = $item->variedad;
                    echo Model_Variedad::find($v)->get('nombre');
                ?></td>
			<td><?php echo $item->total;
                if(!isset($total[$v])){
                    $total[$v] = $item->total;
                }else{
                    $total[$v] += $item->total;
                } ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('entrega/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle', array('class' => 'btn btn-default')); ?>
                        <?php /*echo Html::anchor('entrega/edit/'.$item->id, '<i class="icon-wrench"></i> Editar', array('class' => 'btn btn-small'));*/ ?>
                        <?php /*echo Html::anchor('entrega/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Borrar', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('¿Estás seguro de esto?')"));*/ ?>
                    </div>
				</div>

			</td>
		</tr>
<?php endforeach;?>
    </tbody>
</table>

    <br/>

    <h3 class="print"><u>Resumen de kg. entregados por variedad de aceituna</u></h3>
    <table class="table table-striped print">
        <thead>
        <tr>
            <th>Variedad</th>
            <th>Total entregado</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($total as $v => $t): ?>
            <tr>
                <td><?php echo Model_Variedad::find($v)->get('nombre'); ?></td>
                <td><?php echo $t; ?>  Kgs.</td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <br/>
<?php else: ?>
<p>No se han registrado aún entregas.</p>
<br/>
<?php endif; ?>
<p>
    <?php echo Html::anchor('javascript:window.print()', '<span class="glyphicon glyphicon-print"></span> Imprimir entrada diaria', array('class' => 'btn btn-small btn-info','id'=>'print-deliverynote')); ?>
    <?php if(isset($puesto)){ ?>
        <?php echo Html::anchor('entrega/fechas/'.$idpuesto, 'Consultar entrada en otra fecha', array('class' => 'btn btn-success')); ?>
    <?php } ?>
</p>