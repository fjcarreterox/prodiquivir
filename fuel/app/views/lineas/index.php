<h2>Listing <span class='muted'>Lineas</span></h2>
<br>
<?php if ($lineas): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Idfactura</th>
			<th>Concepto</th>
			<th>Precio</th>
			<th>Kg</th>
			<th>Importe</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($lineas as $item): ?>		<tr>

			<td><?php echo $item->idfactura; ?></td>
			<td><?php echo $item->concepto; ?></td>
			<td><?php echo $item->precio; ?></td>
			<td><?php echo $item->kg; ?></td>
			<td><?php echo $item->importe; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('lineas/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('lineas/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('lineas/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Lineas.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('lineas/create', 'Add new Linea', array('class' => 'btn btn-success')); ?>

</p>
