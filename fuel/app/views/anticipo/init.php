<?php
if(isset($_POST["anticipo_submit"])){
    Response::redirect('anticipo/list_prov/'.$_POST["provider"]);
}
else{
    $provs = Model_Proveedor::find('all',array('select' => array('id', 'nombre'),'order_by' => 'nombre'));
    $options[0]="-- SELECCIONA UN PROVEEDOR --";
    foreach($provs as $prov){
        $options[$prov->get('id')]=$prov->get('nombre');
    }

    echo Form::open(array("class"=>"form-horizontal")); ?>
    <fieldset>
        <div class="form-group">
            <?php echo Form::label('Selecciona proveedor para ver sus anticipos', 'provider', array('class'=>'control-label')); ?>
            <?php echo Form::select('provider', isset($anticipo) ? $anticipo->idprov : '' , $options, array('class' => 'col-md-4 form-control', 'placeholder'=>'')); ?>
        </div>
        <div class="form-group">
            <label class='control-label'>&nbsp;</label>
            <?php echo Form::submit('anticipo_submit', 'Ver anticipos', array('class' => 'btn btn-primary')); ?>
        </div>
    </fieldset>
    <?php echo Form::close();
}?>