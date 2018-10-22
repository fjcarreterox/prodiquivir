<?php
$prov = Model_Proveedor::find($factura->idprov);
$ftemp=explode('-',date_conv($factura->fecha));
?>
<div id="page-wrap">
    <textarea id="header">RECIBO</textarea>
    <div id="identity">
        <div id="address">
            <p>PRODIQUIVIR, S.L.U.</p>
            <p class="smaller">N.I.F. B-90390527</p>
            <p class="smallest">C/ Tres de Abril, 9 - 1º - Teléfono 954 77 19 29<br/>
                41100 CORIA DEL RIO (Sevilla)</p>
        </div>
        <div class="customer">
        <p>DATOS DEL PROVEEDOR</p>
            <textarea id="customer-title">
<?php echo $prov->get('nombre')."\r\n";?>
<?php echo $prov->get('domicilio')."\r\n";?>
<?php echo $prov->get('poblacion')."\r\n";?>
<?php echo $prov->get('nifcif')."\r\n";?>
</textarea>
        </div>
    </div>

    <div style="clear:both"></div>
    <div id="customer">
        <table id="meta">
            <tr>
                <td class="meta-head">Recibo Núm.</td>
                <td class="idfactura"><?php echo $factura->num_factura; ?></td>
            </tr>
            <tr>

                <td class="meta-head">Fecha</td>
                <td><?php echo date_conv($factura->fecha); ?></td>
            </tr>
            <tr>
                <td class="meta-head">Total</td>
                <td><div class="total_fac"><?php echo $factura->total; ?></div></td>
            </tr>
        </table>
    </div>

    <table id="items">
        <tr>
            <th width="45%">Concepto</th>
            <th width="20%">Precio</th>
            <th width="15%">Kg.</th>
            <th width="20%">Importe</th>
        </tr>
        <?php if(!isset($lineas)): ?>
            <tr class="item-row">
                <td class="item-concept"><div class="delete-wpr"><textarea>_Concepto_</textarea><a class="delete" href="javascript:;" title="Remove row">X</a></div></td>
                <td><textarea class="coste">0.00 &euro;</textarea></td>
                <td><textarea class="kg">1</textarea></td>
                <td><span class="precio">0.00 &euro;</span></td>
            </tr>
        <?php else:
            foreach($lineas as $l){ ?>
                <tr class="item-row" data-id="<?php echo $l->id; ?>">
                    <td class="item-concept"><div class="delete-wpr"><textarea><?php echo $l->concepto; ?></textarea><a class="delete" href="javascript:;" title="Borrar fila">X</a></div></td>
                    <td><textarea class="coste"><?php echo $l->precio; ?></textarea> &euro;</td>
                    <td><textarea class="kg"><?php echo $l->kg; ?></textarea></td>
                    <td><span class="precio"><?php echo number_format($l->precio*$l->kg,2, '.', ''); ?> &euro;</span></td>
                </tr>
        <?php }
            endif; ?>
        <tr id="hiderow">
            <td colspan="5"><a id="addrow_bill" href="javascript:;" title="Nueva línea de factura"><img src="../../assets/img/plus.png" alt="Nueva línea de factura"/></a></td>
        </tr>

        <tr>
            <td colspan="0" class="blank"> </td>
            <td colspan="2" class="total-line">Base Imponible</td>
            <td class="total-value"><div id="subtotal">0.00 &euro;</div></td>
        </tr>
        <tr>
            <td colspan="1" class="blank"> </td>
            <td colspan="1" class="total-line">Compensación</td>
            <td class="total-value"><textarea id="iva"><?php echo $factura->iva;?></textarea> %</td>
            <td class="total-iva"> </td>
        </tr>
        <tr>
            <td colspan="1" class="blank"> </td>
            <td colspan="2" class="total-line">Suma</td>
            <td class="total-value"><div id="parcial">0.00 &euro;</div></td>
        </tr>
        <tr>
            <td colspan="1" class="blank"> </td>
            <td colspan="1" class="total-line">Retención</td>
            <td class="total-value"><textarea id="retencion"><?php echo $factura->retencion;?></textarea> %</td>
            <td class="total-retencion"> </td>
        </tr>
        <tr>
            <td colspan="1" class="blank"> </td>
            <td colspan="2" class="total-line">Cuota Interprofesional</td>
            <td class="total-value"><textarea id="cuota"><?php echo $factura->cuota;?></textarea></td>
        </tr>
        <tr>
            <td colspan="1" class="blank"> </td>
            <td colspan="2" class="total-line balance">TOTAL EUROS</td>
            <td class="total-value balance"><div class="total_fac">0.00 &euro;</div></td>
        </tr>
    </table>
    <!--<div class="comment">
        <p>Comentario:</p><textarea><?php /*echo $factura->comentario;*/ ?></textarea>
    </div>-->
	<div id="terms">
        <h5>Firma:</h5><br/>
        <p>MANIFIESTA: que se encuentra acogido al R.E.A.G.P</p>
        <p>En Coria del Río, a <?php echo $ftemp[0];?> de <?php echo getMes($ftemp[1]);?> de <?php echo $ftemp[2];?></p></br>
    </div>

    <?php echo Form::open(array("class"=>"form-horizontal")); ?>
        <?php echo Form::input('idfactura',$factura->id, array('type'=>'hidden','id'=>'idfactura' )); ?>
        <?php echo Form::input('num_factura',$factura->num_factura, array('type'=>'hidden' )); ?>
        <?php echo Form::input('fecha',$factura->fecha, array('type'=>'hidden' )); ?>
        <?php echo Form::input('iva',$factura->iva , array('type'=>'hidden' )); ?>
        <?php echo Form::input('retencion',$factura->retencion , array('type'=>'hidden' )); ?>
        <?php echo Form::input('cuota',$factura->cuota , array('type'=>'hidden' )); ?>
        <?php echo Form::input('total_factura',0 , array('type'=>'hidden' )); ?>
        <?php echo Form::input('comentario','', array('type'=>'hidden' )); ?>

        <div class="form-group">
            <label class='control-label'>&nbsp;</label>
            <?php echo Form::submit('submit_lines', '+ Guardar factura', array('class' => 'btn btn-primary')); ?>
            <?php echo Html::anchor('javascript:window.print()', '<span class="glyphicon glyphicon-print"></span> Imprimir factura', array('class' => 'btn btn-small btn-info','id'=>'print-invoice')); ?>
            <?php echo Html::anchor('factura/list', '<span class="glyphicon glyphicon-backward"></span> Volver al listado', array('class' => 'btn btn-small btn-danger','id'=>'print-invoice', 'onclick' => "return confirm('¿Estás seguro de querer salir de esta factura? Perderá todos los cambios no guardados.')")); ?>
        </div>
    <?php echo Form::close(); ?>
</div>