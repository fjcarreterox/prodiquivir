<h2>Seleccione al proveedor que entrega la mercancía:</h2>
<p>Vas a registrar una nueva entrada en el puesto de <b><?php echo Model_Puesto::find(\Fuel\Core\Session::get('puesto'))->get('nombre'); ?></b>.</p>
<?php if( isset($_POST['submit'])){
    \Fuel\Core\Session::_init();
    \Fuel\Core\Session::set('ses_prov',$_POST['username']);
    \Fuel\Core\Session::set('ses_idalbaran',$_POST['albaran']);

    $new_albaran = new Model_Albaran();
    $new_albaran->idalbaran = $_POST['albaran'];
    $new_albaran->save();
    $id = Model_Albaran::find('last')->get('id');
    \Fuel\Core\Session::set('ses_idalbaran_ID',$id);
    Response::redirect('entrega/create');
}
else {
    ?>
    <br>
    <p>
        <?php
        foreach ($proveedores as $p) {
            $provs[$p->get('id')] = $p->get('nombre');
        }

        //$props = array('idalbaran' => $idAlbaran+1);
        //$new = new Model_Albaran($props);
        //$new->save();
        /*echo Html::anchor('entrega/create', 'Añadir nueva entrega', array('class' => 'btn btn-success'));*/ ?></p>
    <?php echo Form::open('entrega/index', array("class" => "form-horizontal")); ?>

    <fieldset>
        <div class="form-group">
            <?php echo Form::label('Albarán número', 'albaran', array('class' => 'control-label')); ?>
            <?php echo Form::input('albaran', $idAlbaran+1, array('class' => 'col-md-4 form-control', 'readonly' =>'readonly')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Proveedor', 'username', array('class' => 'control-label')); ?>
            <?php echo Form::select('username', '', $provs, array('class' => 'col-md-4 form-control')); ?>
        </div>
        <br/>
        <br/>

        <div class="form-group">
            <label class='control-label'>&nbsp;</label>
            <?php echo Form::submit('submit', 'Añadir nueva entrega para este proveedor', array('class' => 'btn btn-primary')); ?>
        </div>
    </fieldset>
    <?php echo Form::close();
}?>
