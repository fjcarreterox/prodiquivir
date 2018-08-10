<h2>Calcular un nuevo <span class='muted'>anticipo</span></h2>
<br>
<p>Seleccione el proveedor al que quieres calcular el siguiente anticipo:</p>

<?php if( isset($_POST['anticipo_submit'])){
    \Fuel\Core\Session::_init();
    \Fuel\Core\Session::set('ses_anticipo_prov',$_POST['provider']);
    Response::redirect('anticipo/calculo');
}
else {
    if ($proveedores):
        $provs[0]="-- SELECCIONA UN PROVEEDOR --";
        foreach ($proveedores as $p) {
            $provs[$p->get('id')] = $p->get('nombre');
        }

        echo Form::open('anticipo/index', array("class" => "form-horizontal sel-prov")); ?>

        <fieldset>
            <div class="form-group">
                <?php echo Form::label('Nombre del proveedor', 'provider', array('class' => 'control-label')); ?>
                <?php echo Form::select('provider', '', $provs, array('class' => 'col-md-4 form-control')); ?>
            </div>
            <br/>
            <br/>

            <div class="form-group">
                <label class='control-label'>&nbsp;</label>
                <?php echo Form::submit('anticipo_submit', 'Calcular anticipo para este proveedor', array('class' => 'btn btn-primary')); ?>
            </div>
        </fieldset>
        <?php echo Form::close();


    else: ?>
        <p>No se han encontrado proveedores.</p>

    <?php endif;

}?>
