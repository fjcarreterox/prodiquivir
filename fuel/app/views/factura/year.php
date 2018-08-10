<h2>Listado global de <span class='muted'>facturas</span> emitidas<?php echo $titulo; ?></h2>
<br/>
<?php if ($facturas): ?>
    <p>Se encuentran ordenadas descendientemente por número de factura.</p>
    <br/>
<table class="table table-striped">
	<thead>
		<tr>
            <th>Nº Factura</th>
            <th>Proveedor</th>
            <th>CIF</th>
			<th>Fecha</th>
			<th>Importe total (&euro;)</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($facturas as $item): ?>		<tr>
            <td><?php echo $item->num_factura; ?></td>
            <td><?php echo Model_Proveedor::find($item->idprov)->get('nombre'); ?></td>
			<td><?php echo Model_Proveedor::find($item->idprov)->get('nifcif'); ?></td>
			<td><?php echo date_conv($item->fecha); ?></td>
            <td><?php echo $item->total; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('factura/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver Detalle', array('class' => 'btn btn-small btn-default')); ?>
                        <?php echo Html::anchor('factura/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-small btn-success')); ?>
                        <?php echo Html::anchor('factura/print/'.$item->id, '<span class="glyphicon glyphicon-print"></span> Ver líneas', array('class' => 'btn btn-small btn-info')); ?>
                        <?php echo Html::anchor('factura/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Eliminar', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('¿Estás seguro de querer borrar esta factura?')")); ?>
                    </div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No se han encontrado facturas hasta ahora.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('factura/create', 'Emitir nueva factura', array('class' => 'btn btn-success')); ?>

</p>