<h2>Todos los <span class='muted'>proveedores</span></h2>
<br/>
<p><?php echo $intro;?>: <strong><?php echo count($proveedors);?> proveedores.</strong></p>
<br/>
<p>
    <?php echo Html::anchor('proveedor/create', '<span class="glyphicon glyphicon-plus"></span> Añadir nuevo', array('class' => 'btn btn-success')); ?>
    <?php echo Html::anchor('proveedor/search', '<span class="glyphicon glyphicon-search"></span> Buscar proveedor', array('class' => 'btn btn-info')); ?>
    <?php echo Html::anchor('entrega', '<span class="glyphicon glyphicon-plus"></span> Nueva entrega', array('class' => 'btn btn-success')); ?>
</p>
<?php if ($proveedors):
    $action = \Request::active()->action;
    ?>
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
<?php foreach ($proveedors as $item): ?>		<tr>
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
						<?php echo Html::anchor('proveedor/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver ficha', array('class' => 'btn btn-sm btn-default')); ?>
                        <?php echo Html::anchor('proveedor/edit/'.$item->id.'/'.$action, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-sm btn-success')); ?>
                        <?php echo Html::anchor('entrega/list_prov/'.$item->id, '<span class="glyphicon glyphicon-paperclip"></span> Ficha final', array('class' => 'btn btn-sm btn-warning')); ?>
                        <?php echo Html::anchor('anticipo/list_prov/'.$item->id, '<span class="glyphicon glyphicon-euro"></span> Anticipos', array('class' => 'btn btn-sm btn-info')); ?>
                        <?php echo Html::anchor('factura/list_prov/'.$item->id, '<span class="glyphicon glyphicon-credit-card"></span> Hco.facturas', array('class' => 'btn btn-sm btn-info')); ?>
						<?php echo Html::anchor('proveedor/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('¿Estás seguro de esto? El borrado de un proveedor conllevará al borrado de sus facturas, anticipos, albaranes y entregas asociadas.')")); ?>
                    </div>
				</div>
			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No se han encontrado proveedores.</p>

<?php endif; ?><p>
    <?php echo Html::anchor('proveedor/create', '<span class="glyphicon glyphicon-plus"></span> Añadir nuevo', array('class' => 'btn btn-success')); ?>
    <?php echo Html::anchor('proveedor/search', '<span class="glyphicon glyphicon-search"></span> Buscar proveedor', array('class' => 'btn btn-info')); ?>
    <?php echo Html::anchor('entrega', '<span class="glyphicon glyphicon-plus"></span> Nueva entrega', array('class' => 'btn btn-success')); ?>
</p>
