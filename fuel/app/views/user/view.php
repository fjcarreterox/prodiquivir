<h2>Mostrando los datos del <span class='muted'>usuario <?php /*echo $user->id;*/ ?></span>seleccionado</h2>
<br/>
<p><strong>Nombre de usuario: </strong><?php echo $user->username; ?></p>
<p><strong>Puesto de recogida: </strong><?php echo Model_Puesto::find($user->idpuesto)->get('nombre'); ?></p>
<br/>
<p><?php echo Html::anchor('user/edit/'.$user->id, '<span class="glyphicon glyphicon-pencil"></span> Editar',array('class'=>'btn btn-success')); ?>&nbsp;
<?php echo Html::anchor('user', '<span class="glyphicon glyphicon-backward"></span> Volver',array('class'=>'btn btn-danger')); ?></p>