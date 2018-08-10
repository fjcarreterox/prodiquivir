<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Idfactura', 'idfactura', array('class'=>'control-label')); ?>

				<?php echo Form::input('idfactura', Input::post('idfactura', isset($linea) ? $linea->idfactura : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Idfactura')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Concepto', 'concepto', array('class'=>'control-label')); ?>

				<?php echo Form::input('concepto', Input::post('concepto', isset($linea) ? $linea->concepto : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Concepto')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Precio', 'precio', array('class'=>'control-label')); ?>

				<?php echo Form::input('precio', Input::post('precio', isset($linea) ? $linea->precio : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Precio')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Kg', 'kg', array('class'=>'control-label')); ?>

				<?php echo Form::input('kg', Input::post('kg', isset($linea) ? $linea->kg : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Kg')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Importe', 'importe', array('class'=>'control-label')); ?>

				<?php echo Form::input('importe', Input::post('importe', isset($linea) ? $linea->importe : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Importe')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>