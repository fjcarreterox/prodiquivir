<?php
\Fuel\Core\Session::delete('idprov');
$vars=Session::get();
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
    <p>Para ir al final de esta página para consultar <b>los resúmenes</b>, haz click <a href="#reports">aqui</a>.</p>
    <br/>
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
            <th>Tamaño medio</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php
$total = array();
$tam_total = array();
$num_entregas = array();
$total_kg_tam = array();
$rep_m = array("O"=>0,"A"=>0,"B"=>0,"C"=>0,"D"=>0);
$rep_g = array("O"=>0,"A"=>0,"B"=>0,"C"=>0);
$rango_molino = array("R1"=>0,"R2"=>0,"R3"=>0/*,"R4"=>0*/);
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
    if($item->variedad==1){
        if($item->tam == 0) $rep_m["O"] += $item->total;
        if(($item->tam > 0) && ($item->tam <= 240)) $rep_m["A"] += $item->total;
        if(($item->tam > 240) && ($item->tam <= 260)) $rep_m["B"] += $item->total;
        if(($item->tam > 260) && ($item->tam <= 300)) $rep_m["C"] += $item->total;
        else if($item->tam > 300) $rep_m["D"] += $item->total;
    }
    else if($item->variedad==2){
        if($item->tam == 0) $rep_g["O"] += $item->total;
        if(($item->tam > 0) && ($item->tam <= 120)) $rep_g["A"] += $item->total;
        if(($item->tam > 120) && ($item->tam <= 130)) $rep_g["B"] += $item->total;
        else if($item->tam > 130) $rep_g["C"] += $item->total;
    }
    else if($item->variedad==3){
        if(($item->fecha > "2022-01-01") && ($item->fecha <= "2022-10-09")) $rango_molino["R1"] += $item->total;
        if(($item->fecha > "2022-10-10") && ($item->fecha <= "2022-10-30")) $rango_molino["R2"] += $item->total;
        if(($item->fecha > "2022-10-31") && ($item->fecha <= "2022-12-31")) $rango_molino["R3"] += $item->total;
        //if(($item->fecha > "2022-11-13") && ($item->fecha <= "2022-12-31")) $rango_molino["R4"] += $item->total;
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
                <?php echo $item->tam;
                if(!isset($tam_total[$v])){
                    $tam_total[$v] = $item->tam*$item->total;
                }else{
                    $tam_total[$v] += $item->tam*$item->total;
                }
                if(!isset($num_entregas[$v])){
                    $num_entregas[$v] = 1;
                }else{
                    $num_entregas[$v]++;
                }

                if($item->tam!=0) {
                    if(!isset($total_kg_tam[$v]))
                        $total_kg_tam[$v]=$item->total;
                    else
                        $total_kg_tam[$v]+=$item->total;
                }
                ?>
            </td>
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
    <a id="reports"></a>
    <h3 class="print"><u>Resumen de kg. entregados por variedad de aceituna</u></h3>
    <table class="table table-striped print">
        <thead>
        <tr>
            <th>Variedad</th>
            <th>Total entregado en la campaña</th>
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

    <h3 class="print"><u>Resumen de tamaño medio por variedad de aceituna</u></h3>
    <table class="table table-striped print">
        <thead>
        <tr>
            <th>Variedad</th>
            <th>Tamaño medio entregado (campaña actual)</th>
            <th>Media <u>del puesto actual</u> durante la campaña</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($tam_total as $v => $t): ?>
            <tr>
                <td><?php echo Model_Variedad::find($v)->get('nombre'); ?></td>
                <td><?php
                    if(isset($total_kg_tam[$v])){echo number_format($t/$total_kg_tam[$v],2);}
                    else{echo 0.00;}
                    ?></td>
                <td><?php echo number_format(getTamMedio($vars["puesto"],$v),2); ?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <br/>
    <h3 class="print"><u>Distribución de kgrs. por <b>rangos de tamaño</b></u></h3>
    <table class="table table-striped print">
        <thead>
        <h4><b>Tipo Manzanilla</b></h4>
        <tr>
            <th>0</th>
            <th>< 240</th>
            <th>241-260</th>
            <th>261-300</th>
            <th>301-N</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php foreach ($rep_m as $rango=>$v):{
                echo "<td>".$v."</td>";
            }
            endforeach;
            ?>
        </tr>
        </tbody>
    </table>
    <br/>
    <br/>
    <table class="table table-striped print">
        <thead>
        <h4><b>Tipo Gordal</b></h4>
        <tr>
            <th>0</th>
            <th>< 120</th>
            <th>121 - 130</th>
            <th>131 - N</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php foreach ($rep_g as $rango=>$v):{
                echo "<td>".$v."</td>";
            }
            endforeach;
            ?>
        </tr>
        </tbody>
    </table>
    <br/>
    <h3 class="print"><u>Distribución de kgrs. por <b>rangos de fecha</b></u></h3>
    <table class="table table-striped print">
        <thead>
        <h4><b>Tipo Molino</b></h4>
        <tr>
            <th>Inicio campaña - 9/10</th>
            <th>10/10 - 30/10</th>
            <th>31/10 - 31/12</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php foreach ($rango_molino as $rango => $v):{
                echo "<td>".$v."</td>";
            }
            endforeach;
            ?>
        </tr>
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
    <?php echo Html::anchor('/', '<span class="glyphicon glyphicon-backward"></span> Menú principal', array('class' => 'btn btn-danger','title'=>'Volver al menu')); ?>
</p>