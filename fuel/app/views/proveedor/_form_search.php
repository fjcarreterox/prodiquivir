<?php echo Form::open(array("class"=>"form-horizontal")); ?>
<p>Escribe el nombre del proveedor que deseas buscar (al menos <strong>tres</strong> caracteres):</p>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Nombre del proveedor', 'searchq', array('class'=>'control-label')); ?>
			<?php echo Form::input('searchq','', array('class' => 'col-md-4 form-control', 'placeholder'=>'Nombre que deseas buscar')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Buscar', array('class' => 'btn btn-primary')); ?>
        </div>
	</fieldset>
<p><small><u>NOTA:</u> Aunque los proveedores se hayan almacenado con letras mayúsculas, esta pantalla de búsqueda permite buscar
proveedores escribiendo sus nombres en minúscula.  Tampoco es necesario
        buscar con tildes. Sólo se busca por <strong>nombre</strong> del proveedor.</small></p>
<?php echo Form::close(); ?>