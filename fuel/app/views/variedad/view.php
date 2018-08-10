<h2>Mostrando datos del puesto de <span class='muted'><?php echo $puesto->nombre; ?></span></h2>
<br/>
<p>
	<strong>Nombre del puesto de recogida:</strong>
	<?php echo $puesto->nombre; ?></p>
<br/>
<?php echo Html::anchor('puesto/edit/'.$puesto->id, '<span class="glyphicon glyphicon-pencil"></span> Cambiar nombre',array('class'=>'btn btn-success')); ?>
<?php echo Html::anchor('puesto', '<span class="glyphicon glyphicon-backward"></span> Volver',array('class'=>'btn btn-danger')); ?>