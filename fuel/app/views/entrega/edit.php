<h2>Editando la <span class='muted'>Entrega</span> seleccionada:</h2>
<br>
<?php echo render('entrega/_form'); ?>
<p>
	<?php echo Html::anchor('entrega/view/'.$entrega->id, 'Ver'); ?> |
	<?php echo Html::anchor('entrega/list', 'Volver'); ?></p>
