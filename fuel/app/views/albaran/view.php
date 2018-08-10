<h2>Mostrando detalle de <span class='muted'>albarán:</span></h2>
<?php
	$v=Session::get();
	$albaran=array_shift($albaranes);
?>	
<br/>
<p>
	<strong>Núm Albarán:</strong>
	<?php echo $albaran->idalbaran; ?></p>
<p>
    <strong>Fecha:</strong>
    <?php echo date_conv($albaran->fecha); ?></p>
<p>
	<strong>Detalle de entrega(s)</strong></p>
    <table class="table table-striped">
        <tr>
	<?php
        foreach($entregas as $e) {
            echo "<td>".Html::anchor('entrega/view/'.$e, 'Entrega #'.$e)."</td>";
        }
    ?>
        </tr>
</table>
<p>
	<strong>Proveedor:</strong>
	<?php 
		$n=Model_Proveedor::find($albaran->idproveedor);
 		if($n != null){
 			echo $n->get('nombre');
 		}
 		else{
 			echo '<span class="totaleuros">¡ERROR! Albarán sin Proveedor asociado.</span>';
 		}
	?></p>
<p>
    <strong>Comentario:</strong>
    <?php echo $albaran->comentario; ?></p>
<br/><br/>
<?php 
		$year = date('Y',$albaran->created_at);
		echo Html::anchor('albaran/edit/'.$albaran->id, '<span class="glyphicon glyphicon-pencil"></span> Editar',array('class' => 'btn btn-success')); 
if($v['username']=="javi" || $v['username']=="Rocio" ){
    echo Html::anchor('albaran/edit_prov/' . $albaran->idalbaran . '/' . $albaran->idproveedor, '<span class="glyphicon glyphicon-pencil"></span> Cambiar proveedor', array('class' => 'btn btn-success'));
}
?>
<?php echo Html::anchor('albaran/print/'.$albaran->idalbaran.'/'.$year, '<span class="glyphicon glyphicon-print"></span> Imprimir',array('class' => 'btn btn-sm btn-info')); ?>
<?php echo Html::anchor('albaran/list', '<span class="glyphicon glyphicon-backward"></span> Volver al listado',array('class' => 'btn btn-sm btn-danger'));?>
<?php
    if($v['username']=="javi" || $v['username']=="Rocio" ){
        echo Html::anchor('albaran/delete/' . $albaran->id, '<span class="glyphicon glyphicon-trash"></span> Borrar este albarán', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('¿Estás seguro de esto? El borrado de un albarán conllevará el borrado de sus entregas asociadas.')"));
    }
?>