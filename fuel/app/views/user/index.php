<h2><span class='muted'>Usuarios del sistema</span></h2>
<br/>
<?php if ($users):
    foreach ($puestos as $p) {
        $p_array[$p->get('id')] = $p->get('nombre');
    }
    ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre de usuario</th>
            <th>Puesto asociado</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($users as $item): ?>
		<tr>
			<td><?php echo $item->username; ?></td>
            <td><?php echo Model_Puesto::find($item->idpuesto)->get('nombre'); ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('user/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver Ficha', array('class' => 'btn btn-default')); ?>
                        <?php echo Html::anchor('user/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-success')); ?>
                        <?php echo Html::anchor('user/new_pass/'.$item->id, '<span class="glyphicon glyphicon-refresh"></span> Cambiar contraseña', array('class' => 'btn btn-small btn-info right-separator')); ?>
                        <?php
                            if(\Fuel\Core\Session::get('username') == "javi") {
                                echo Html::anchor('user/delete/' . $item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de esto?')"));
                            }
                        ?>
                    </div>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p>No se han encontrado usuarios.</p>
<?php endif; ?>
<p><?php echo Html::anchor('user/create', '<span class="glyphicon glyphicon-plus"></span> Añadir nuevo usuario', array('class' => 'btn btn-success')); ?></p>
