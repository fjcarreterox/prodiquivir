<h2><span class='muted'>Variedades</span> de aceituna gestionadas</h2>
<br>
<?php if ($variedads): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>En anticipo</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($variedads as $item): ?>		<tr>

			<td><?php echo $item->nombre; ?></td>
			<td><?php
                if($item->en_anticipo)
                    echo "SÍ";
                else
                    echo "NO";
                ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('variedad/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver ficha', array('class' => 'btn btn-small btn-default')); ?>
                        <?php echo Html::anchor('variedad/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-small btn-success')); ?>
                        <?php /*echo Html::anchor('variedad/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Borrar', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure?')"));*/ ?>
                    </div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>
<p><small><u>NOTA</u>: Dado que estas variedades están estrechamente relacionadas con las entregas y los cálculos de anticipos a los proveedores,
se ha desabilitado el borrado de las mismas para no causar inconsistencias en la aplicación.</small></p>
<br/>
<?php else: ?>
<p>No se han encontrado variedades de aceitunas.</p>
<?php endif; ?><p>
	<?php echo Html::anchor('variedad/create', '<span class="glyphicon glyphicon-plus"></span> Añadir nueva Variedad', array('class' => 'btn btn-success')); ?>

</p>