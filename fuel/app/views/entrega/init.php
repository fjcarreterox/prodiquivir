<?php if(isset($_POST["entrega_submit"])){
    Response::redirect('entrega/list_prov/'.$_POST["provider"]);
}
else {
    echo "<h2 > Selecciona a un proveedor para ver su ficha final:</h2 >";
    $provs[0] = "-- SELECCIONA UN PROVEEDOR --";
    foreach ($proveedores as $p) {
        $provs[$p->get('id')] = $p->get('nombre');
    }
    echo Form::open('entrega/init', array("class" => "form-horizontal")); ?>

    <fieldset>
        <div class="form-group">
            <?php echo Form::select('provider', '', $provs, array('class' => 'col-md-4 form-control')); ?>
        </div>
        <br/>
        <br/>

        <div class="form-group">
            <label class='control-label'>&nbsp;</label>
            <?php echo Form::submit('entrega_submit', 'Consultar su ficha final', array('class' => 'btn btn-primary')); ?>
        </div>
    </fieldset>
    <?php echo Form::close();
}?>