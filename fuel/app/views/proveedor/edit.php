<h2>Editando los datos del <span class='muted'>Proveedor</span></h2>
<br/>
<?php echo render('proveedor/_form'); ?>
<p><?php echo Html::anchor('proveedor/view/'.$proveedor->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver ficha',array('class'=>'btn btn-default')); ?>
	<?php echo Html::anchor('proveedor', '<span class="glyphicon glyphicon-backward"></span> Volver',array('class'=>'btn btn-danger')); ?></p>
