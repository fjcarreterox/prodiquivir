<h2>Resumen de la <span class='muted'>factura nº<?php echo $factura->num_factura; ?></span> seleccionada:</h2>
<br/>
<p>
	<strong>Proveedor:</strong>
	<?php echo Model_Proveedor::find($factura->idprov)->get('nombre'); ?></p>
<p>
    <strong>Fecha de emisión:</strong>
    <?php echo date_conv($factura->fecha); ?></p>
<p>
    <strong>IVA aplicado:</strong>
    <?php echo $factura->iva; ?> %</p>
<p>
    <strong>Retención aplicada:</strong>
    <?php echo $factura->retencion; ?> %</p>
<p>
    <strong>Cuota interprofesional aplicada:</strong>
    <?php echo $factura->cuota; ?> &euro;</p>
<p>
	<strong>Importe total:</strong>
	<?php echo $factura->total; ?> &euro;</p>
<p>
    <strong>Comentario:</strong>
    <?php echo $factura->comentario; ?></p>
<br/>
<?php echo Html::anchor('factura/print/'.$factura->id, 'Ver líneas',array('class'=>'btn btn-info')); ?>&nbsp;
<?php echo Html::anchor('factura/edit/'.$factura->id, 'Editar',array('class'=>'btn btn-success')); ?>&nbsp;
<?php echo Html::anchor('factura/list', 'Volver al listado',array('class'=>'btn btn-danger')); ?>