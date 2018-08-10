<h2>Editando los datos propios de la <span class='muted'>factura</span> seleccionada</h2>
<br/>
<p>Si deseas modificar las líneas de factura que componen esta factura o los datos que aparecen en gris, haz clic en el botón verde de abajo.</p>
<?php echo render('factura/_form'); ?>
<p>
	<?php echo Html::anchor('factura/view/'.$factura->id, 'Ver datos', array('class'=>'btn btn-default')); ?>&nbsp;&nbsp;
	<?php echo Html::anchor('factura/list', 'Volver al listado', array('class'=>'btn btn-danger')); ?></p>