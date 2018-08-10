<?php
    echo "<h2 > Selecciona el <strong>nuevo proveedor</strong> que deseas asignar a este albarán:</h2 >";
    $provs[0] = "-- SELECCIONA UN PROVEEDOR --";
    foreach ($proveedores as $p) {
        $provs[$p->get('id')] = $p->get('nombre');
    }
    echo Form::open(array("class" => "form-horizontal")); ?>
    <fieldset>
        <div class="form-group">
            <?php echo Form::label('Núm. Albarán', 'idalbaran', array('class'=>'control-label')); ?>
            <?php echo Form::input('idalbaran', $idalb, array('class' => 'col-md-4 form-control', 'placeholder'=>'Idalbaran','readonly'=>'readonly')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Nuevo proveedor (por defecto seleccionamos el actual)', 'provider', array('class'=>'control-label')); ?>
            <?php echo Form::select('provider', $current, $provs, array('class' => 'col-md-4 form-control')); ?>
        </div>
        <br/>
        <br/>

        <div class="form-group">
            <label class='control-label'>&nbsp;</label>
            <?php echo Form::button('editprov_submit', '<span class="glyphicon glyphicon-pencil"></span> Cambiar proveedor', array('class' => 'btn btn-primary','type'=>'submit')); ?>
        </div>
    </fieldset>
    <?php echo Form::close();
?>