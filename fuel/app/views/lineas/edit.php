<h2>Editing <span class='muted'>Linea</span></h2>
<br>

<?php echo render('lineas/_form'); ?>
<p>
	<?php echo Html::anchor('lineas/view/'.$linea->id, 'View'); ?> |
	<?php echo Html::anchor('lineas', 'Back'); ?></p>
