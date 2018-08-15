<?php
//$prov=Model_Proveedor::find($albaran->get('idproveedor'));
?>

<div id="page-wrap">
    <textarea id="header">RECIBÍ</textarea>
    <div style="clear:both"></div>
    <p class="recibi">RECIBÍ de <b>PRODIQUIVIR S.L.</b> el siguiente <strong>anticipo</strong> por CAMPAÑA <?php echo date('Y');?>:</p>
    <div id="customer">
        <table id="anticipo">
            <tr>
                <td class="meta-head">Fecha</td>
                <td><?php echo date_conv($anticipo->fecha);?></td>
            </tr>
            <tr>
                <td class="meta-head">Núm. cheque</td>
                <td><?php echo $anticipo->numcheque;?></td>
            </tr>
            <tr>
                <td class="meta-head">Banco</td>
                <td><?php echo Model_Banco::find($anticipo->idbanco)->get('nombre');?></td>
            </tr>
            <tr>
                <td class="meta-head">Importe</td>
                <td><?php echo $anticipo->cuantia;?> &euro;</td>
            </tr>
        </table>
    </div>
    <div id="terms">
      <h5>Conforme,</h5><br/><br/>
    </div>
    <br/>
    <div class="provider">
        <p class="recibi">Fdo: <?php echo Model_Proveedor::find($anticipo->idprov)->get('nombre')?></p>
    </div>
</div>
<?php echo Html::anchor('javascript:window.print()', '<span class="glyphicon glyphicon-print"></span> Imprimir recibí', array('class' => 'btn btn-small btn-info','id'=>'print-deliverynote')); ?>
<?php echo Html::anchor('anticipo', '<span class="glyphicon glyphicon-plus"></span> Calcular nuevo anticipo', array('class' => 'btn btn-small btn-success')); ?> 