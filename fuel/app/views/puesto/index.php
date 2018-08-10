<h2>Listado de <span class='muted'>puestos</span> activos.</h2>
<br>
<p>Selecciona la acción concreta que quieres realizar sobre uno de los puestos de recogida de la empresa:</p>
<?php if ($puestos): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre del puesto de recogida</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($puestos as $item): ?>		<tr>

			<td><?php echo $item->nombre; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('puesto/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver Ficha', array('class' => 'btn btn-sm btn-default')); ?>
                        <?php echo Html::anchor('puesto/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-sm btn-success')); ?>
                        <?php echo Html::anchor('entrega/list/'.$item->id, '<span class="glyphicon glyphicon-list-alt"></span> Entrada diaria', array('class' => 'btn btn-sm btn-info')); ?>
                    </div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Puestos.</p>

<?php endif; ?><p><?php echo Html::anchor('puesto/create', '<span class="glyphicon glyphicon-plus"></span> Añadir un nuevo puesto', array('class' => 'btn btn-success')); ?></p>
