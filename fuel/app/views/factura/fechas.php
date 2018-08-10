<?php
echo Form::open(array("class" => "form-horizontal"));
echo "<h2>Resumen de IVA y retenciones</h2 >";?>
    <br/>
    <p class="hide_elem">Selecciona un rango de fechas para obtener el resumen de IVA y retenciones.</p>
    <p class="hide_elem">Para obtener resultados, asegúrate de que la <b>fecha final</b> es posterior a la <b>inicial</b>.</p>
    <br/>
    <fieldset class="hide_elem">
        <div class="form-group">
            <?php echo Form::label('Fecha inicial', 'start', array('class'=>'control-label')); ?>
            <?php echo Form::input('start', '', array('type'=>'date','class' => 'col-md-4 form-control')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Fecha final', 'end', array('class'=>'control-label')); ?>
            <?php echo Form::input('end', '', array('type'=>'date','class' => 'col-md-4 form-control')); ?>
        </div>
        <br/>
        <div class="form-group">
            <label class='control-label'>&nbsp;</label>
            <?php echo Form::button('submit', '<span class="glyphicon glyphicon-ok"></span> Consultar resumen de IVA y retenciones', array('class' => 'btn btn-primary','type'=>'submit')); ?>
        </div>
    </fieldset>
<?php echo Form::close();
    if(count($facturas)>0):
        echo Html::anchor('javascript:window.print()', '<span class="glyphicon glyphicon-print"></span> Imprimir resumen', array('class' => 'btn btn-small btn-info','id'=>'print-invoice'));
        echo "<br/><br/><p>Mostrando resumen de IVA y retenciones entre el <b>".date_conv($_POST["start"])."</b> y el <b>".date_conv($_POST["end"])."</b>.</p>";
        echo "<p>Total de facturas encontradas: <b>".count($facturas)."</b></p><br/>";

        $total_ret = 0;
        $iva_array = array("4"=>array("base"=>0,"comp"=>0,"suma"=>0),
            "10"=>array("base"=>0,"comp"=>0,"suma"=>0),
            "12"=>array("base"=>0,"comp"=>0,"suma"=>0)
        );

        foreach($facturas as $f){

            $lineas = Model_Linea::find('all',array('where'=>array("idfactura"=>$f->get('id'))));
            $base = 0;$iva = 0;$comp = 0;$suma = 0;
            foreach($lineas as $l){
                $base += $l->get('importe');
            }

            $iva = $f->get('iva');
            $iva_array[$iva]["base"] += $base;
            $comp = number_format(($base*$f->get('iva'))/100,2,'.','');
            $iva_array[$iva]["comp"] += $comp;
            $suma = $base+number_format(($base*$f->get('iva'))/100,2,'.','');
            $iva_array[$iva]["suma"] += $suma;

            if($f->get('retencion')==2){
                $ret = number_format(($suma*$f->get('retencion'))/100,2,'.','');
                $total_ret += $ret;
                //$total_ret += number_format(($base+number_format(($base*$f->get('iva'))/100,2)*$f->get('retencion'))/100,2,'.','');

            }
            //echo "Base: $base, IVA: $iva, Comp: $comp, suma: $suma, retencion: $ret <br/>";
        }

        ?>
        <h3>Acumulado de IVA</h3>
        <table class="table table-striped print">
            <thead>
            <tr>
                <td>&nbsp;</td>
                <td>Bases imponibles</td>
                <td>Compensación</td>
                <td>Suma</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>IVA al <strong>4%</strong></td>
                <td><?php echo $iva_array["4"]["base"]; ?></td>
                <td><?php echo $iva_array["4"]["comp"]; ?></td>
                <td><?php echo $iva_array["4"]["suma"]; ?></td>
            </tr>
            <tr>
                <td>IVA al <strong>10%</strong></td>
                <td><?php echo $iva_array["10"]["base"]; ?></td>
                <td><?php echo $iva_array["10"]["comp"]; ?></td>
                <td><?php echo $iva_array["10"]["suma"]; ?></td>
            </tr>
            <tr>
                <td>IVA al <strong>12%</strong></td>
                <td><?php echo $iva_array["12"]["base"]; ?></td>
                <td><?php echo $iva_array["12"]["comp"]; ?></td>
                <td><?php echo $iva_array["12"]["suma"]; ?></td>
            </tr>
            </tbody>
        </table>
        <br/>

        <h3>Acumulado de retenciones</h3>
        <table class="table table-striped print">
            <tr>
                <td>Retenciones al 2%</td>
                <td><?php echo $total_ret;?> &euro;</td>
            </tr>
        </table>
        <br/>
    <?php else: ?>
        <?php if(isset($_POST["submit"])):?>
            <p>No se han encontrado facturas en el intervalo de tiempo especificado. Prueba con otras fechas.</p>
        <?php endif; ?>
    <?php endif; ?>
