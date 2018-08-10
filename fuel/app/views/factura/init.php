<?php
if(isset($_POST["factura_submit"])){
    Response::redirect('factura/list_prov/'.$_POST["idprov"]);
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
                <?php echo Form::label('Selecciona proveedor para ver sus facturas', 'idprov', array('class'=>'control-label')); ?>
                <?php echo Form::select('idprov', isset($factura) ? $factura->idprov : '' , $options, array('class' => 'col-md-4 form-control', 'placeholder'=>'')); ?>
            </div>
            <div class="form-group">
                <label class='control-label'>&nbsp;</label>
                <?php echo Form::submit('factura_submit', 'Ver facturas', array('class' => 'btn btn-primary')); ?>
            </div>
        </fieldset>
    <?php echo Form::close();
}?>