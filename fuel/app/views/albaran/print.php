<?php
$albaran=array_shift($albaranes);	
$prov=Model_Proveedor::find($albaran->get('idproveedor'));
?>

<div id="page-wrap">
		<textarea id="header">ALBARÁN</textarea>
		<div id="identity">
            <div id="address">
                <p>PRODIQUIVIR, S.L.U.</p>
                <p class="smaller">N.I.F. B-90390527</p>
                <p class="smallest">C/ Tres de Abril, 9 - 1º - Teléfono 954 77 19 29<br/>
                    41100 CORIA DEL RIO (Sevilla)</p>
            </div>
            <div class="customer">
                <p>DATOS DEL PROVEEDOR</p>
            <textarea id="customer-title">
<?php echo $prov->get('nombre')."\r\n";?>
<?php echo $prov->get('domicilio')."\r\n";?>
<?php echo $prov->get('poblacion')."\r\n";?>
<?php echo $prov->get('nifcif')."\r\n";?>
</textarea>
            </div>
		</div>
		
		<div style="clear:both"></div>
		<div id="customer">
            <table id="meta">
                <tr>
                    <td class="meta-head">Albarán Núm.</td>
                    <td><?php echo $albaran->get('idalbaran');?></td>
                </tr>
                <tr>

                    <td class="meta-head">Fecha</td>
                    <td><?php echo date_conv($albaran->get('fecha'));?></td>
                </tr>
            </table>
		</div>
		
		<table id="items">
		  <tr>
		      <th>Variedad</th>
              <th>Comentario (%)</th>
		      <th>Tamaño</th>
		      <th>Total kgrs.</th>
		  </tr>

<?php
    $total_manz=0;
    $total_gordal=0;
    $total_molino=0;
	$comments="";
    foreach($entregas as $identrega){
        $e=Model_Entrega::find($identrega);
		$comments .= $e->envases.". ";

        ?>
		  <tr class="item-row">
		      <td class="item-name"><?php
                  echo Model_Variedad::find($e->get('variedad'))->get('nombre');
                  if($e->get('variedad')==1){$total_manz+=$e->get('total');}
                  elseif($e->get('variedad')==2){$total_gordal+=$e->get('total');}
                  elseif($e->get('variedad')==3){$total_molino+=$e->get('total');}

                  ?></td>
		      <td class="comentario"><?php echo get_percents($e);?></td>
		      <td class="cost"><?php echo $e->get('tam');?></td>
		      <td class="total-kg"><?php echo $e->get('total');?></td>
		  </tr>
            <?php
    }
?>
            <tr>
                <td colspan="2" class="blank"> </td>
                <td colspan="1" class="total-line">Total Manzanilla</td>
                <td class="total-value"><div id="total"><?php echo $total_manz;?> Kgrs.</div></td>
            </tr>
            <tr>
                <td colspan="2" class="blank"> </td>
                <td colspan="1" class="total-line">Total Gordal</td>
                <td class="total-value"><div id="total"><?php echo $total_gordal;?> Kgrs.</div></td>
            </tr>
            <tr>
                <td colspan="2" class="blank"> </td>
                <td colspan="1" class="total-line">Total Molino</td>
                <td class="total-value"><div id="total"><?php echo $total_molino;?> Kgrs.</div></td>
            </tr>
            <!--<tr>
                <td colspan="2" class="blank"> </td>
                <td colspan="1" class="total-line balance">TOTAL KILOS</td>
                <td class="total-value balance"><div class="due"><?php /*echo $total_manz+$total_gordal+$total_molino;*/?> Kgrs.</div></td>
            </tr>-->

		</table>
    <?php if(strcmp($comments,"")!=0) {  ?>
        <div class="comment" >
            <p > Comentario:</p ><?php echo $comments; ?>
        </div>
    <?php
        }
    ?>
		<div id="terms">
		  <h5>Conforme,</h5><br/><br/>
		</div>
		<br/><br/>
        <p class="smaller"><i>* Por el extravío de cada envase el proveedor arriba indicado deberá pagar a Prodiquivir S.L.U. la cantidad de 75€, que le será descontada del total del cobro.</i></p>
	</div>
<?php echo Html::anchor('javascript:window.print()', '<span class="glyphicon glyphicon-print"></span> Imprimir albarán', array('class' => 'btn btn-small btn-info','id'=>'print-deliverynote')); ?>
<?php echo Html::anchor('entrega/create', '<span class="glyphicon glyphicon-repeat"></span> Registrar nueva entrega', array('class' => 'btn btn-small btn-success')); ?>
<?php echo Html::anchor('albaran/edit/'.$albaran->get('id'), '<span class="glyphicon glyphicon-pencil"></span> Editar datos de este albarán', array('class' => 'btn btn-success','target'=>'_blank','title'=>'Se abre en ventana nueva...')); ?>