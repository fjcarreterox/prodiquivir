<h2>Mostrando detalles del banco <span class='muted'><?php echo $banco->nombre; ?></span></h2>

<p>
	<strong>Nombre:</strong>
	<?php echo $banco->nombre; ?></p>

<?php echo Html::anchor('banco/edit/'.$banco->id, 'Editar',array('class'=>'btn btn-success')); ?>&nbsp;
<?php echo Html::anchor('banco', 'Volver al listado',array('class'=>'btn btn-danger')); ?>