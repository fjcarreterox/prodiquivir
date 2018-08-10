<?php
$provs = Model_Proveedor::find('all',array('select' => array('id', 'nombre'),'order_by' => 'nombre'));
$options[0]="-- SELECCIONA UN PROVEEDOR --";
foreach($provs as $prov){
    $options[$prov->get('id')]=$prov->get('nombre');
}

echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
<div class="form-group">
            <?php echo Form::label('Número de factura', 'num_factura', array('class'=>'control-label')); ?>
            <?php echo Form::input('num_factura', isset($factura) ? $factura->num_factura : $num_fact+1 , array('class' => 'col-md-4 form-control', 'readonly'=>'readonly')); ?>
        </div>
		<div class="form-group">
			<?php echo Form::label('Selecciona proveedor', 'idprov', array('class'=>'control-label')); ?>
				<?php echo Form::select('idprov', isset($factura) ? $factura->idprov : '' , $options, array('class' => 'col-md-4 form-control', 'placeholder'=>'')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Fecha de emisión', 'fecha', array('class'=>'control-label')); ?>
				<?php echo Form::input('fecha', Input::post('fecha', isset($factura) ? $factura->fecha : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Fecha', 'type' => 'date')); ?>
		</div>
        <div class="form-group">
            <?php echo Form::label('IVA aplicado', 'iva', array('class'=>'control-label')); ?>
            <?php echo Form::input('iva', Input::post('iva', isset($factura) ? $factura->iva : 12), array('class' => 'col-md-4 form-control','readonly'=>'readonly' )); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Retención aplicada', 'retencion', array('class'=>'control-label')); ?>
            <?php echo Form::input('retencion', Input::post('retencion', isset($factura) ? $factura->retencion : 2), array('class' => 'col-md-4 form-control','readonly'=>'readonly' )); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Cuota interprofesional aplicada', 'cuota', array('class'=>'control-label')); ?>
            <?php echo Form::input('cuota', Input::post('cuota', isset($factura) ? $factura->cuota : 0), array('class' => 'col-md-4 form-control','readonly'=>'readonly' )); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Suma total de la factura', 'total', array('class'=>'control-label')); ?>
            <?php echo Form::input('total', Input::post('total', isset($factura) ? $factura->total : 0), array('class' => 'col-md-4 form-control','readonly'=>'readonly' )); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Comentario', 'comentario', array('class'=>'control-label')); ?>
            <?php echo Form::input('comentario', Input::post('comentario', isset($factura) ? $factura->comentario : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Comentario sobre la factura')); ?>
        </div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('factura_submit', '<span class="glyphicon glyphicon-plus"></span> Completar líneas de factura', array('class' => 'btn btn-primary','type'=>'submit')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>