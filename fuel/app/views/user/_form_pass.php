<p>Las constraseñas deberán coincidir para que el cambio se realice correctamente.</p>
<?php
    echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Nueva contraseña', 'pass', array('class'=>'control-label')); ?>
			<?php echo Form::password('pass', Input::post('pass',''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Nueva contraseña')); ?>
    	</div>
       <!-- <div class="form-group">
            <?php /*echo Form::label('Repite la contraseña', 'pass2', array('class'=>'control-label'));*/ ?>
            <?php /*echo Form::password('pass2', Input::post('pass2',''), array('class' => 'col-md-4 form-control', 'placeholder'=>'De nuevo la contraseña'));*/ ?>
        </div>-->
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Guardar nueva contraseña', array('class' => 'btn btn-primary')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>