<?php
$liq_ops = array(0=>"NO",1=>"SÍ");

echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Nombre', 'nombre', array('class'=>'control-label')); ?>
			<?php echo Form::input('nombre', Input::post('nombre', isset($proveedor) ? $proveedor->nombre : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Nombre del proveedor o razón social de la empresa')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Domicilio', 'domicilio', array('class'=>'control-label')); ?>
			<?php echo Form::input('domicilio', Input::post('domicilio', isset($proveedor) ? $proveedor->domicilio : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Domicilio')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Población', 'poblacion', array('class'=>'control-label')); ?>
			<?php echo Form::input('poblacion', Input::post('poblacion', isset($proveedor) ? $proveedor->poblacion : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Población')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('NIF/CIF', 'nifcif', array('class'=>'control-label')); ?>
			<?php echo Form::input('nifcif', Input::post('nifcif', isset($proveedor) ? $proveedor->nifcif : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'NIF ó CIF del proveedor')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Teléfono', 'telefono', array('class'=>'control-label')); ?>
			<?php echo Form::input('telefono', Input::post('telefono', isset($proveedor) ? $proveedor->telefono : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Teléfono de contacto')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Tipo de proveedor', 'tipo', array('class'=>'control-label'));
            $options=array(
                'persona fisica'=>'Persona Física',
                'empresa'=>'Empresa'
            );
            echo Form::select('tipo', '', $options, array('class' => 'col-md-4 form-control'));
            ?>
		</div>
        <div class="form-group">
            <?php echo Form::label('Comentario', 'comentario', array('class'=>'control-label')); ?>
            <?php echo Form::input('comentario', Input::post('comentario', isset($proveedor) ? $proveedor->comentario : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Comentario')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Envases prestados', 'envases', array('class'=>'control-label')); ?>
            <?php echo Form::input('envases', Input::post('envases', isset($proveedor) ? $proveedor->envases : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Núm. envases prestados')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Liquidado', 'liquidado', array('class'=>'control-label')); ?>
            <?php echo Form::select('liquidado', Input::post('liquidado', isset($proveedor) ? $proveedor->liquidado : ''),$liq_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Núm. envases prestados')); ?>
        </div>
        <br/>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-save"></span> Guardar cambios', array('class' => 'btn btn-primary','type'=>'submit')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>