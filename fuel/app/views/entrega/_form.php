<?php echo Form::open(array("class"=>"form-horizontal"));

$vars=Model_Variedad::find('all');
$provs=Model_Proveedor::find('all',array("order_by"=>"nombre"));

$options_vars=array();
$options_provs=array();

foreach($vars as $var){
    $options_vars[$var->get('id')]=$var->get('nombre');
}

$options_provs[0]="-- SELECCIONA UN PROVEEDOR --";
foreach ($provs as $p) {
    $options_provs[$p->get('id')] = $p->get('nombre');
}

$percents=array(
    0=>'0%',
    5=>'5%',
    10=>'10%',
    15=>'15%',
    20=>'20%',
    25=>'25%',
    30=>'30%',
    35=>'35%',
    40=>'40%',
    45=>'45%',
    50=>'50%',
    55=>'55%',
    60=>'60%',
    65=>'65%',
    70=>'70%',
    75=>'75%',
    80=>'80%',
    85=>'85%',
    90=>'90%',
    95=>'95%',
    100=>'100%',
);

$idpuesto = Model_Puesto::find(\Fuel\Core\Session::get('puesto'))->get('id');
$puesto = Model_Puesto::find($idpuesto)->get('nombre');
$show_select=false;
$idprov=\Fuel\Core\Session::get('idprov');

if($idprov==""){
    if(isset($entrega)) {
        $idprov = Model_Albaran::find($entrega->albaran)->get('idproveedor');
    }else{
        $idprov='';
        $show_select=true;
    }
}
?>
    <p>Puesto donde se hace la entrega: <strong><?php echo $puesto; ?></strong></p>
    <?php   if(!$show_select){
        echo "<p>Una entrega más para <b>".Model_Proveedor::find($idprov)->get('nombre')."</b></p>";
    }?>
	<fieldset>
        <div class="form-group">
            <?php echo Form::hidden('idpuesto', Input::post('idpuesto', isset($entrega) ? $entrega->idpuesto : $idpuesto), array('class' => 'col-md-4 form-control')); ?>
            <?php echo Form::hidden('albaran', Input::post('albaran', isset($entrega) ? $entrega->albaran : ''), array('class' => 'col-md-4 form-control')); ?>
        </div>
<?php   if($show_select){ ?>
        <div class="form-group">
            <?php echo Form::label('Proveedor que hace la entrega', 'idprov', array('class'=>'control-label')); ?>
            <?php echo Form::select('idprov', $idprov, $options_provs, array('class' => 'col-md-4 form-control', 'placeholder'=>'Proveedor')); ?>
        </div>
<?php
        }else{
            echo Form::hidden('idprov', $idprov, array('class' => 'col-md-4 form-control'));
        }
?>
		<div class="form-group">
			<?php echo Form::label('Fecha de la entrega', 'fecha', array('class'=>'control-label')); ?>
			<?php echo Form::input('fecha', Input::post('fecha', isset($entrega) ? $entrega->fecha : date('Y-m-d')), array('type' => 'date','class' => 'col-md-4 form-control', 'placeholder'=>'Fecha')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Variedad entregada', 'variedad', array('class'=>'control-label')); ?>
			<?php echo Form::select('variedad',Input::post('variedad', isset($entrega) ? $entrega->variedad : ''), $options_vars, array('class' => 'col-md-4 form-control', 'placeholder'=>'Variedad')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Tamaño', 'tam', array('class'=>'control-label')); ?>
			<?php echo Form::input('tam', Input::post('tam', isset($entrega) ? $entrega->tam : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Tamaño')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Total pesados (kgrs.)', 'total', array('class'=>'control-label')); ?>
			<?php echo Form::input('total', Input::post('total', isset($entrega) ? $entrega->total : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Total Kg pesados')); ?>
		</div>
		<div class="form-group">
 			<?php echo Form::label('Envases prestados', 'envases', array('class'=>'control-label')); ?>
 			<?php echo Form::input('envases', Input::post('envases', isset($entrega) ? $entrega->envases : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Núm. envases prestados al proveedor')); ?>
 		</div>
        <p>Consiguientes porcentajes de:</p>
		<div class="form-group">
			<?php echo Form::label('Picado', 'rate_picado', array('class'=>'control-label')); ?>
			<?php echo Form::select('rate_picado', Input::post('rate_picado', isset($entrega) ? $entrega->rate_picado : ''),$percents, array('class' => 'col-md-4 form-control', 'placeholder'=>'% picado')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Molestado', 'rate_molestado', array('class'=>'control-label')); ?>
			<?php echo Form::select('rate_molestado', Input::post('rate_molestado', isset($entrega) ? $entrega->rate_molestado : ''),$percents, array('class' => 'col-md-4 form-control', 'placeholder'=>'% molestado')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Morado', 'rate_morado', array('class'=>'control-label')); ?>
			<?php echo Form::select('rate_morado', Input::post('rate_morado', isset($entrega) ? $entrega->rate_morado : ''),$percents, array('class' => 'col-md-4 form-control', 'placeholder'=>'% morado')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Mosca', 'rate_mosca', array('class'=>'control-label')); ?>
			<?php echo Form::select('rate_mosca', Input::post('rate_mosca', isset($entrega) ? $entrega->rate_mosca : ''),$percents, array('class' => 'col-md-4 form-control', 'placeholder'=>'% mosca')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Azofairon', 'rate_azofairon', array('class'=>'control-label')); ?>
			<?php echo Form::select('rate_azofairon', Input::post('rate_azofairon', isset($entrega) ? $entrega->rate_azofairon : ''),$percents, array('class' => 'col-md-4 form-control', 'placeholder'=>'% azofairon')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Agostado', 'rate_agostado', array('class'=>'control-label')); ?>
			<?php echo Form::select('rate_agostado', Input::post('rate_agostado', isset($entrega) ? $entrega->rate_agostado : ''),$percents, array('class' => 'col-md-4 form-control', 'placeholder'=>'% agostado')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Granizado', 'rate_granizado', array('class'=>'control-label')); ?>
			<?php echo Form::select('rate_granizado', Input::post('rate_granizado', isset($entrega) ? $entrega->rate_granizado : ''),$percents, array('class' => 'col-md-4 form-control', 'placeholder'=>'% granizado')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Perdigon', 'rate_perdigon', array('class'=>'control-label')); ?>
			<?php echo Form::select('rate_perdigon', Input::post('rate_perdigon', isset($entrega) ? $entrega->rate_perdigon : ''),$percents, array('class' => 'col-md-4 form-control', 'placeholder'=>'% perdigon')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Taladro', 'rate_taladro', array('class'=>'control-label')); ?>
			<?php echo Form::select('rate_taladro', Input::post('rate_taladro', isset($entrega) ? $entrega->rate_taladro : ''),$percents, array('class' => 'col-md-4 form-control', 'placeholder'=>'% taladro')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
            <?php
            if(\Fuel\Core\Request::active()->action=="edit"){
                echo Form::submit('save', 'Guardar cambios', array('class' => 'btn btn-primary'));
            }
            else{
				echo Form::button('more', '<span class="glyphicon glyphicon-plus"></span> Agregar más entregas', array('class' => 'btn btn-primary'));
                echo Form::button('end', '<span class="glyphicon glyphicon-ok"></span> Finalizar entrega(s)', array('class' => 'btn btn-primary','type' => 'submit'));
                echo Html::anchor('entrega/list', '<i class="icon-trash icon-white"></i> Cancelar esta entrega', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('¿Estás seguro?')"));
            }
            ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>