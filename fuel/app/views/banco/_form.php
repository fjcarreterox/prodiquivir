<?php echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Nombre', 'nombre', array('class'=>'control-label')); ?>
			<?php echo Form::input('nombre', Input::post('nombre', isset($banco) ? $banco->nombre : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Nombre de la entidad bancaria')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Guardar', array('class' => 'btn btn-primary')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>