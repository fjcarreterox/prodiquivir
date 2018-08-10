<?php echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Núm. Albarán', 'idalbaran', array('class'=>'control-label')); ?>
			<?php echo Form::input('idalbaran', Input::post('idalbaran', isset($albaran) ? $albaran->idalbaran : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Idalbaran','readonly'=>'readonly')); ?>
		</div>
		<?php echo Form::input('identrega', Input::post('identrega', isset($albaran) ? $albaran->identrega : ''), array('class' => 'col-md-4 form-control', 'type'=>'hidden')); ?>
		<div class="form-group">
			<?php echo Form::label('Proveedor', 'idproveedor', array('class'=>'control-label')); ?>
			<?php echo Form::input('idproveedor', Input::post('idproveedor', isset($albaran) ? $albaran->idproveedor : ''), array('class' => 'col-md-4 form-control', 'type'=>'hidden')); ?>
			<?php echo Form::input('idproveedor_name', Input::post('idproveedor_name', isset($albaran) ? Model_Proveedor::find($albaran->idproveedor)->get('nombre') : ''), array('class' => 'col-md-4 form-control', 'readonly'=>'readonly')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Fecha del albarán', 'fecha', array('class'=>'control-label')); ?>
			<?php echo Form::input('fecha', Input::post('fecha', isset($albaran) ? $albaran->fecha : ''), array('class' => 'col-md-4 form-control', 'type'=>'date')); ?>
		</div>
        <div class="form-group">
            <?php echo Form::label('Comentario', 'comentario', array('class'=>'control-label')); ?>
            <?php echo Form::input('comentario', Input::post('comentario', isset($albaran) ? $albaran->comentario : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Comentario')); ?>
        </div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-plus"></span> Guardar cambios', array('class' => 'btn btn-primary','type'=>'submit')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>