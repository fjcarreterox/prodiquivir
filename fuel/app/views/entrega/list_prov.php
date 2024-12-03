<?php
/*if(isset($puesto)){
    echo "<h2>Entrega diaria para el puesto <span class='muted'>$puesto.</span></h2>";
    echo "<h3>Día: <span class='muted'>".date_conv($fecha)."</span></h3>";
}
else{*/
    if(empty($tlfno)){$tlfno="No Espec.";}
    echo "<h3><span class='muted'>Ficha final</span> del proveedor <b>$nombre_prov.</b> ($tlfno)</h3>";
//}
?>
<br/>
<p><?php echo Html::anchor('javascript:window.print()', '<span class="glyphicon glyphicon-print"></span> Imprimir ficha final', array('class' => 'btn btn-info','id'=>'print-deliverynote')); ?>
    <?php echo Html::anchor('/', '<span class="glyphicon glyphicon-backward"></span> Menú principal', array('class' => 'btn btn-danger','title'=>'Volver al menu')); ?>
    <?php /*echo Html::anchor('proveedor/ficha_final/'.$idc, '<span class="glyphicon glyphicon-print"></span> Generar PDF', array('class' => 'btn btn-info','id'=>'print-deliverynote','target'=>'_blank'));*/ ?></p>
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
$total_kg_tam = array();
$total_tam = array();
$rep_m = array("O"=>0,"A"=>0,"B"=>0,"C"=>0,"D"=>0,"E"=>0,"F"=>0,"G"=>0/*,"H"=>0,"I"=>0,"J"=>0*/);
$rep_g = array("O"=>0,"A"=>0,"B"=>0,"C"=>0,"D"=>0,"E"=>0);
$rango_molino = array("R1"=>0,"R2"=>0,"R3"=>0,"R4"=>0,"R5"=>0);

foreach ($entregas as $item):?>
    <tr>
			<td><?php echo date_conv($item->fecha); ?></td>
            <td><?php echo Model_Albaran::find($item->albaran)->get('idalbaran'); ?></td>
			<td><?php echo Model_Variedad::find($item->variedad)->get('nombre');?></td>
            <td class="gris"><?php echo $item->tam;

            if($item->tam!=0) {
                $total_tam[$item->variedad][] = $item->tam * $item->total;
                if(!isset($total_kg_tam[$item->variedad]))
                    $total_kg_tam[$item->variedad]=$item->total;
                else
                    $total_kg_tam[$item->variedad]+=$item->total;
            }

            if($item->variedad==1){
                if($item->tam == 0) $rep_m["O"] += $item->total;
                if(($item->tam > 0) && ($item->tam <= 220)) $rep_m["A"] += $item->total;
                if(($item->tam > 220) && ($item->tam <= 240)) $rep_m["B"] += $item->total;
                if(($item->tam > 240) && ($item->tam <= 260)) $rep_m["C"] += $item->total;
                if(($item->tam > 260) && ($item->tam <= 280)) $rep_m["D"] += $item->total;
                if(($item->tam > 280) && ($item->tam <= 300)) $rep_m["E"] += $item->total;
                if(($item->tam > 300) && ($item->tam <= 320)) $rep_m["F"] += $item->total;
                else if($item->tam > 320) $rep_m["G"] += $item->total;
            }
            else if($item->variedad==2){
                if($item->tam == 0) $rep_g["O"] += $item->total;
                if(($item->tam > 0) && ($item->tam <= 59)) $rep_g["A"] += $item->total;
                if(($item->tam > 59) && ($item->tam <= 90)) $rep_g["B"] += $item->total;
                if(($item->tam > 90) && ($item->tam <= 110)) $rep_g["C"] += $item->total;
                if(($item->tam > 110) && ($item->tam <= 130)) $rep_g["D"] += $item->total;
                else if($item->tam > 130) $rep_g["E"] += $item->total;
            }
            else if($item->variedad==3){
                if(($item->fecha >= "2024-01-01") && ($item->fecha <= "2024-10-13")) $rango_molino["R1"] += $item->total;
                if(($item->fecha >= "2024-10-14") && ($item->fecha <= "2024-11-03")) $rango_molino["R2"] += $item->total;
                if(($item->fecha >= "2024-11-04") && ($item->fecha <= "2024-11-10")) $rango_molino["R3"] += $item->total;
                if(($item->fecha >= "2024-11-11") && ($item->fecha <= "2024-11-17")) $rango_molino["R4"] += $item->total;
                if(($item->fecha >= "2024-11-18") && ($item->fecha <= "2024-11-24")) $rango_molino["R5"] += $item->total;
            }
                ?></td>
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
    <h3 class="print"><u>Distribución de kgrs. según tamaño (rangos)</u></h3>
<table class="table table-striped print">
    <thead>
    <h4><b>Tipo Manzanilla</b></h4>
    <tr>
        <th>0</th>
        <th>< 220</th>
        <th>221-240</th>
        <th>241-260</th>
        <th>261-280</th>
        <th>281-300</th>
        <th>301-320</th>
        <th>321-N</th>
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
            <th>< 60</th>
            <th>60 - 90</th>
            <th>91 - 110</th>
            <th>111 - 130</th>
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
<h3 class="print"><u>Distribución de kgrs. por rangos de fecha</u></h3>
<table class="table table-striped print">
    <thead>
    <h4><b>Tipo Molino</b></h4>
    <tr>
        <th>Inicio campaña - 13/10</th>
        <th>14/10 - 3/11</th>
        <th>4/11 - 10/11</th>
        <th>11/11 - 17/11</th>
        <th>18/11 - 24/11</th>
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
    <br/>
<h3 class="print"><u><b>Tamaños medio</b> por variedad de aceituna</u></h3>
<?php if (!empty($total_tam)): ?>
    <table class="table table-striped print">
    <thead>
    </thead>
    <tbody>
    <?php
    foreach ($total_tam as $v => $value):?>
        <tr>
            <td><?php echo "Tamaño medio ".Model_Variedad::find($v)->get('nombre'); ?></td>
            <td><?php echo number_format(array_sum($value)/$total_kg_tam[$v],4);?></td>
        </tr>
    <?php endforeach;?>
    </tbody>
    </table>
    <?php else: ?>
        <p class="print">No se han localizado entregas con tamaños significativos para este proveedor.</p>
    <?php endif; ?>
    <br/>
    <br/>
    <h3 class="print"><u>Resumen de <b>kg. entregados</b> por variedad de aceituna</u></h3>
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
    <br/>
    <h3 class="anticipo print"><u>Listado de anticipos entregados</u></h3>
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
    <p class="total print">En total, suman: <span class="totaleuros"><?php echo number_format($suma,2); ?> &euro;.</span></p>
    <?php else: ?>
        <p class="print">No se han registrado aún anticipos para este proveedor.</p>
    <?php endif; ?>
    <br/>
<?php else: ?>
<p>No se han registrado aún entregas.</p>

<?php endif; ?><p>
    <?php echo Html::anchor('javascript:window.print()', '<span class="glyphicon glyphicon-print"></span>  Imprimir ficha final', array('class' => 'btn btn-info','id'=>'print-deliverynote')); ?>
    <?php echo Html::anchor('/', '<span class="glyphicon glyphicon-backward"></span> Menú principal', array('class' => 'btn btn-danger','title'=>'Volver al menu')); ?>
    <?php /*echo Html::anchor('proveedor/ficha_final/'.$idc, '<span class="glyphicon glyphicon-print"></span> Generar PDF', array('class' => 'btn btn-info','id'=>'print-deliverynote'));*/ ?>
</p>
<script type="text/javascript">
    var total = $("p.total");
    $($("h3.anticipo")[2]).next().append("<br/><br/>").append(total);
</script>