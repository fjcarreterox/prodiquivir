<h2>Editando datos del <span class='muted'>usuario:</span></h2>
<br/>
<?php echo render('user/_form_edit'); ?>
<p><?php echo Html::anchor('user/view/'.$user->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver ficha', array('class'=>'btn btn-default')); ?>&nbsp;
	<?php echo Html::anchor('user', '<span class="glyphicon glyphicon-backward"></span> Volver', array('class'=>'btn btn-danger')); ?></p>
