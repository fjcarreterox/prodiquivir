<?php
   	$idalbaran=Model_Albaran::find($entrega->albaran)->get('idalbaran');
	$f = explode('-',$entrega->fecha);
?>
<h2>Mostrando detalle de la <span class='muted'>entrega de mercancía</span> seleccionada:</h2>
<br/>
<p>
	<strong>Fecha de la entrega:</strong>
	<?php echo date_conv($entrega->fecha); ?></p>
<p>
	<strong>Núm. Albaran en la que aparece la entrega:</strong>
	<?php echo Html::anchor('albaran/view/'.$idalbaran.'/'.$f[0], $idalbaran,array('target'=>'_blank')); ?></p>
<p>
	<strong>Variedad de aceituna registrada:</strong>
	<?php echo Model_Variedad::find($entrega->variedad)->get('nombre'); ?></p>
<p>
	<strong>Tamaño de la muestra:</strong>
	<?php echo $entrega->tam; ?></p>
<p>
	<strong>Total peso de la muestra:</strong>
	<?php echo $entrega->total; ?> kgrs.</p>
<p>
	<strong>Tabla de porcentajes:</strong></p>

	<table summary="Porcentajes observados" class="table table-striped percents">
        <tr>
            <td>Picado</td>
            <td><?php echo $entrega->rate_picado; ?>%</td>
        </tr>
        <tr>
            <td>Molestado</td>
            <td><?php echo $entrega->rate_molestado; ?>%</td>
        </tr>
        <tr>
            <td>Morado</td>
            <td><?php echo $entrega->rate_morado; ?>%</td>
        </tr>
        <tr>
            <td>Mosca</td>
            <td><?php echo $entrega->rate_mosca; ?>%</td>
        </tr>
        <tr>
            <td>Azofairón</td>
            <td><?php echo $entrega->rate_azofairon; ?>%</td>
        </tr>
        <tr>
            <td>Agostado</td>
            <td><?php echo $entrega->rate_agostado; ?>%</td>
        </tr>
        <tr>
            <td>Granizado</td>
            <td><?php echo $entrega->rate_granizado; ?>%</td>
        </tr>
        <tr>
            <td>Perdigón</td>
            <td><?php echo $entrega->rate_perdigon; ?>%</td>
        </tr>
        <tr>
            <td>Taladro</td>
            <td><?php echo $entrega->rate_taladro; ?>%</td>
        </tr>
    </table>

<?php echo Html::anchor('entrega/edit/'.$entrega->id, '<span class="glyphicon glyphicon-pencil"></span> Editar',array('class'=>'btn btn-success')); ?>&nbsp;
<?php echo Html::anchor('entrega/list', '<span class="glyphicon glyphicon-backward"></span> Volver',array('class'=>'btn btn-danger')); ?>