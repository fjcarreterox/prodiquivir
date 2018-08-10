<h2>Listado de <span class='muted'>bancos</span> del sistema:</h2>
<br>
<?php if ($bancos): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($bancos as $item): ?>		<tr>

			<td><?php echo $item->nombre; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('banco/view/'.$item->id, '<i class="icon-eye-open"></i> Ver Ficha', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('banco/edit/'.$item->id, '<i class="icon-wrench"></i> Editar', array('class' => 'btn btn-success btn-sm')); ?>
                        <?php /*echo Html::anchor('banco/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Borrar', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('¿Estás seguro de esto?')"));*/ ?>
                    </div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>
    <p><small><u>NOTA</u>: Dado que los bancos están estrechamente relacionados con los cálculos de los anticipos a los proveedores,
            se ha desabilitado el borrado de los mismos para no causar inconsistencias en la aplicación.</small></p>
<?php else: ?>
<p>No Bancos.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('banco/create', 'Alta de nuevo banco', array('class' => 'btn btn-success')); ?>

</p>
