<h2>Resumen de IVA y retenciones de las <span class='muted'>facturas</span> registradas en el sistema</h2>
<br/>
<?php if ($facturas):
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
    <?php echo Html::anchor('javascript:window.print()', '<span class="glyphicon glyphicon-print"></span> Imprimir resumen', array('class' => 'btn btn-info')); ?>
    <?php echo Html::anchor('factura/report_fechas', '<span class="glyphicon glyphicon-calendar"></span> Consultar resumen de un periodo', array('class' => 'btn btn-warning')); ?>
<?php else: ?>
<p>No se han encontrado facturas hasta ahora.</p>
<?php endif; ?>
