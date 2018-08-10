<?php
$puestos=Model_Puesto::find('all');
foreach($puestos as $p){
    $options[$p->get('id')]=$p->get('nombre');
}
echo Form::open(array("class"=>"form-horizontal"));?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Nombre de usuario', 'username', array('class'=>'control-label')); ?>
			<?php echo Form::input('username', Input::post('username', isset($user) ? $user->username : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Username')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Contraseña', 'pass', array('class'=>'control-label')); ?>
			<?php echo Form::password('pass', Input::post('pass', isset($user) ? $user->pass : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Contraseña')); ?>
		</div>
        <div class="form-group">
            <?php echo Form::label('Repite tu contraseña', 'pass_2', array('class'=>'control-label')); ?>
            <?php echo Form::password('pass_2', Input::post('pass', isset($user) ? $user->pass : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Contraseña')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Puesto de trabajo', 'idpuesto', array('class'=>'control-label')); ?>
            <?php echo Form::select('idpuesto', '', $options, array('class' => 'col-md-4 form-control', 'placeholder'=>'Puesto')); ?>
        </div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', '+ Guardar datos', array('class' => 'btn btn-primary')); ?>
		</div>
	</fieldset>
<?php echo Form::close(); ?>