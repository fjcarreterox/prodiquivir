<h2>Viewing <span class='muted'>#<?php echo $linea->id; ?></span></h2>

<p>
	<strong>Idfactura:</strong>
	<?php echo $linea->idfactura; ?></p>
<p>
	<strong>Concepto:</strong>
	<?php echo $linea->concepto; ?></p>
<p>
	<strong>Precio:</strong>
	<?php echo $linea->precio; ?></p>
<p>
	<strong>Kg:</strong>
	<?php echo $linea->kg; ?></p>
<p>
	<strong>Importe:</strong>
	<?php echo $linea->importe; ?></p>

<?php echo Html::anchor('lineas/edit/'.$linea->id, 'Edit'); ?> |
<?php echo Html::anchor('lineas', 'Back'); ?>