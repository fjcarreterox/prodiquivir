<h2>Editando datos del <span class='muted'>puesto</span> seleccionado</h2>
<br/>
<?php echo render('puesto/_form'); ?>
<p><?php echo Html::anchor('puesto/view/'.$puesto->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver Ficha',array('class'=>'btn btn-default')); ?>
	<?php echo Html::anchor('puesto', '<span class="glyphicon glyphicon-backward"></span> Volver',array('class'=>'btn btn-danger')); ?></p>
