<?php
if(isset($nombre_prov)){
    $idprov=\Fuel\Core\Session::get('ses_anticipo_prov');
    $label='Registrar anticipo e imprimir recibí';
}else{
    $idprov=$anticipo->idprov;
    $label='Guardar cambios';
    $recogido_sel=$anticipo->recogido;
}

$recogido_ops=array(
    1=>"SÍ",
    0=>"NO"

);

$bancos_ops=array();
foreach ($bancos as $b) {
    $bancos_ops[$b->get('id')]=$b->get('nombre');
}

echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Fecha de registro', 'fecha', array('class'=>'control-label')); ?>
			<?php echo Form::input('fecha', Input::post('fecha', isset($anticipo) ? $anticipo->fecha : ''), array('type' => 'date','class' => 'col-md-4 form-control', 'placeholder'=>'Fecha')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Proveedor (su identificador)', 'idprov', array('class'=>'control-label')); ?>
			<?php echo Form::input('idprov', $idprov, array('class' => 'col-md-4 form-control', 'placeholder'=>'Nombre del proveedor','readonly'=>'readonly')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Núm. de cheque', 'numcheque', array('class'=>'control-label')); ?>
			<?php echo Form::input('numcheque', Input::post('numcheque', isset($anticipo) ? $anticipo->numcheque : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Número de cheque')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Banco', 'idbanco', array('class'=>'control-label')); ?>
			<?php echo Form::select('idbanco', Input::post('idbanco', isset($anticipo) ? $anticipo->idbanco : ''), $bancos_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Banco donde se cobrará el anticipo')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Cuantía a registrar (&euro;)', 'cuantia', array('class'=>'control-label')); ?>
			<?php echo Form::input('cuantia', Input::post('cuantia', isset($cuantia) ? $cuantia : $anticipo->cuantia), array('class' => 'col-md-4 form-control', 'placeholder'=>'Cuantia')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Recogido', 'recogido', array('class'=>'control-label')); ?>
			<?php echo Form::select('recogido', isset($anticipo) ? $recogido_sel: '',$recogido_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Recogido')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-floppy-save"></span> '.$label, array('class' => 'btn btn-primary','type'=>'submit')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>