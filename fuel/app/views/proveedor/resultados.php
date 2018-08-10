<h2>Resultados de búsqueda de <span class='muted'>proveedores</span> de la campaña 2015</h2>
<br>
<p>
    <?php echo Html::anchor('proveedor/create', 'Añadir nuevo', array('class' => 'btn btn-success')); ?>
    <?php echo Html::anchor('proveedor/search', 'Buscar de nuevo', array('class' => 'btn btn-success')); ?>
    <?php echo Html::anchor('entrega', 'Nueva entrega', array('class' => 'btn btn-success')); ?>
</p>
<?php if ($proveedores): ?>
<table class="table table-striped">
	<thead>
		<tr>
            <th>Tipo de proveedor</th>
			<th>Nombre</th>
            <th>Teléfono</th>
			<th>NIF/CIF</th>
            <th>Envases prestados</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($proveedores as $item): ?>		<tr>
            <td><?php
                if(strcmp("empresa",$item->tipo)==0) {
                    echo \Fuel\Core\Asset::img('Iconfactory.png',array("class"=>"icon"));
                }
                else{
                    echo \Fuel\Core\Asset::img('personicon.png',array("class"=>"icon"));
                }
                ?></td>
			<td><?php echo $item->nombre; ?></td>
            <td><?php echo $item->telefono; ?></td>
			<td><?php echo $item->nifcif; ?></td>
            <td><?php echo $item->envases; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('proveedor/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver ficha completa', array('class' => 'btn btn-default')); ?>
                        <?php echo Html::anchor('proveedor/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-success')); ?>
                        <?php /*echo Html::anchor('proveedor/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Borrar', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('¿Estás seguro de esto?')"));*/ ?>
                        <?php /*echo Html::anchor('proveedor/ficha_final/'.$item->id, '<span class="glyphicon glyphicon-paperclip"></span> Ficha final', array('class' => 'btn btn-small btn-warning'));*/ ?>
                        <?php echo Html::anchor('entrega/list_prov/'.$item->id, '<span class="glyphicon glyphicon-paperclip"></span> Ficha final', array('class' => 'btn btn-small btn-warning')); ?>
                        <?php echo Html::anchor('anticipo/list_prov/'.$item->id, '<span class="glyphicon glyphicon-euro"></span> Anticipos', array('class' => 'btn btn-small btn-info')); ?>
                    </div>
				</div>
			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No se han encontrado proveedores.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('proveedor/create', 'Añadir nuevo', array('class' => 'btn btn-success')); ?>
    <?php echo Html::anchor('proveedor/search', 'Buscar de nuevo', array('class' => 'btn btn-success')); ?>
    <?php echo Html::anchor('entrega', 'Nueva entrega', array('class' => 'btn btn-success')); ?>
</p>
