<h2>Mostrando detalle del <span class='muted'>anticipo</span> seleccionado.</h2>

<p>
	<strong>Fecha de registro:</strong>
	<?php echo date_conv($anticipo->fecha); ?></p>
<p>
	<strong>Proveedor:</strong>
	<?php echo Model_Proveedor::find($anticipo->idprov)->get('nombre'); ?></p>
<p>
	<strong>Núm. Cheque:</strong>
	<?php echo $anticipo->numcheque; ?></p>
<p>
	<strong>Banco:</strong>
	<?php echo Model_Banco::find($anticipo->idbanco)->get('nombre'); ?></p>
<p>
	<strong>Cuantía:</strong>
	<?php echo $anticipo->cuantia; ?> &euro;</p>
<p>
	<strong>Recogido por el proveedor:</strong>
	<?php
        if($anticipo->recogido)
            echo "SÍ";
        else
            echo "NO";
    ?></p>

<?php echo Html::anchor('anticipo/edit/'.$anticipo->id, 'Editar'); ?> |
<?php echo Html::anchor('anticipo', 'Volver'); ?>