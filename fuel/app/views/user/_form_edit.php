<?php
$puestos=Model_Puesto::find('all');
foreach($puestos as $p){
    $options[$p->get('id')]=$p->get('nombre');
}
echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Nombre de usuario', 'username', array('class'=>'control-label')); ?>
			<?php echo Form::input('username', Input::post('username', isset($user) ? $user->username : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Username')); ?>
		</div>
        <div class="form-group">
            <?php echo Form::label('Puesto de trabajo', 'idpuesto', array('class'=>'control-label')); ?>
            <?php echo Form::select('idpuesto',$user->idpuesto ,$options, array('class' => 'col-md-4 form-control', 'placeholder'=>'Puesto')); ?>
        </div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-plus"></span> Guardar los cambios', array('class' => 'btn btn-primary','type'=>'submit')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>