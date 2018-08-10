<h2>Listado de <span class='muted'>albaranes</span> de entregas <?php echo $titulo;?></h2>
<br>
<?php if ($albarans): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Albarán núm.</th>
            <th>Fecha</th>
			<th>Proveedor</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php 
		$last_id=0;		
		foreach ($albarans as $item): 
			if($last_id!=$item->idalbaran){
				$last_id=$item->idalbaran;
				$f = explode("-",$item->fecha);

?>
        <tr>
			<td><?php echo $item->idalbaran; ?></td>
            <td><?php echo date_conv($item->fecha);?></td>
			<td><?php echo Model_Proveedor::find($item->idproveedor)['nombre']; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('albaran/view/'.$item->idalbaran.'/'.$f[0], '<span class="glyphicon glyphicon-eye-open"></span> Detalle Albarán', array('class' => 'btn btn-default')); ?>
						<?php echo Html::anchor('albaran/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-success')); ?>
                    </div>
				</div>

			</td>
		</tr>
<?php 
			}
		endforeach; ?>	</tbody>
</table>
<?php else: ?>
<p>No se han encontrado albaranes para mostrar.</p>
<?php endif; ?>