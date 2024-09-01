<?php
    $nombre_proveedor=Model_Proveedor::find(\Fuel\Core\Session::get('ses_anticipo_prov'))->get('nombre');
    //definiendo valores iniciales del formulario
    $totalKg=0;
    $precio=0.30;
    $acum=0;

    //calculando el total de kg de todas las entregas del proveedor seleccionado
    $alb_a = Model_Albaran::find('all',array('where'=>array(array("IdProveedor",\Fuel\Core\Session::get('ses_anticipo_prov')),array('fecha','LIKE','2024%'))));
    $variedades = array();
	$parcial=0;
    foreach($alb_a as $alb) {
        $id_ent = $alb->get('identrega');
        $parcial = Model_Entrega::find($id_ent)->get('total');
        //Filtramos las aceitunas de molino que no entran en el cómputo
        $variedad = Model_Entrega::find($id_ent)->get('variedad');
        $variedad_name = Model_Variedad::find($variedad)->get('nombre');
        if (Model_Variedad::find($variedad)->get('en_anticipo')) {
			$totalKg += $parcial;
			if(isset($variedades[$variedad_name])){$variedades[$variedad_name] += $parcial;}
			else{$variedades[$variedad_name] = $parcial;}                        
        }
    }

    $ant_a = Model_Anticipo::find('all',array('where'=>array(array("idprov",\Fuel\Core\Session::get('ses_anticipo_prov')),array('fecha','LIKE','2024%'))));
    foreach($ant_a as $ant){
        //sólo computan los anticipos que están recogidos.
        if($ant->get('recogido')) {
            $acum += $ant->get('cuantia');
        }
    }
?>
<h2>Calcular un nuevo anticipo para <span class='muted'><?php echo $nombre_proveedor?></span></h2>
<br>
<p>A continuación aparecer el cálculo automático realizado por el sistema:</p>
<br/>
<?php if( isset($_POST['submit'])){
    //\Fuel\Core\Session::_init();
    \Fuel\Core\Session::set('ses_anticipo_cuantia',$_POST['anticipo']);
    Response::redirect('anticipo/create');
}
else {
    if ($anticipos):

        foreach ($anticipos as $a) {
            //$provs[$p->get('id')] = $p->get('nombre');
            //TODO: suma de anticipos anteriores RECOGIDOS
            //$acum ¿?
        }

    else: ?>
        <!--<p>No se han encontrado anticipos anteriores.</p>-->
    <?php endif;
        echo Form::open('anticipo/calculo', array("class" => "form-horizontal")); ?>
        <table id="items">
            <tr>
                <th>Variedad</th>
                <th>Kilos entregados</th>
                <th>Precio por kgr.</th>
            </tr>
            <?php
                $total=0;
                foreach($variedades as $var => $peso) {?>
            <tr class="item-row">
                <td><?php echo $var; ?></td>
                <td><?php echo Form::input('totalkg', $peso, array('class' => 'col-md-4 form-control','readonly'=>'readonly')); ?></td>
                <td><?php echo Form::input('precio', $precio, array('class' => 'col-md-4 form-control')); ?></td>
            </tr>
            <?php
                    $total += $peso*$precio;
                } ?>
        </table>
        <fieldset>
            <div class="form-group">
                <?php echo Form::label('Total €', 'totale', array('class' => 'control-label')); ?>
                <?php echo Form::input('totale', $total, array('class' => 'col-md-4 form-control','readonly'=>'readonly')); ?>
            </div>
            <div class="form-group">
                <?php echo Form::label('Acumulado de anticipos recogidos', 'acum', array('class' => 'control-label')); ?>
                <?php echo Form::input('acum', $acum, array('class' => 'col-md-4 form-control','readonly'=>'readonly')); ?>
            </div>
            <div class="form-group">
                <?php echo Form::label('Anticipo calculado automáticamente (es la que se registrará en el sistema)', 'anticipo', array('class' => 'control-label')); ?>
                <?php echo Form::input('anticipo', ($totalKg*$precio)-$acum, array('class' => 'totaleuros col-md-4 form-control')); ?>
            </div>
            <br/>
            <br/>
            <div class="form-group">
                <label class='control-label'>&nbsp;</label>
                <?php echo Form::submit('submit', 'Registrar anticipo', array('class' => 'btn btn-primary')); ?>
            </div>
        </fieldset>
        <?php echo Form::close();
}?>
<p><small><u>NOTA</u>: Los kg. totales entregados se calculan automáticamente sumando todas las entregas realizadas por el
        proveedor de aceituna gordal y manzanilla. El precio se establece inicialmente en 30 cent. de &euro; pero se puede
    cambiar para el cálculo. </small></p>
<p><small>El anticipo calculado automáticamente es modificable y sólo se registrará en el sistema la cantidad que aparezca en
    la última casilla.</small></p>