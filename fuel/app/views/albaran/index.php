<h2>Listing <span class='muted'>Albarans</span></h2>
<br>
<?php if ($albarans): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Idalbaran</th>
			<th>Identrega</th>
			<th>Idproveedor</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($albarans as $item): ?>		<tr>

			<td><?php echo $item->idalbaran; ?></td>
			<td><?php echo $item->identrega; ?></td>
			<td><?php echo $item->idproveedor; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('albaran/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-small')); ?>
                        <?php echo Html::anchor('albaran/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-small')); ?>
                        <?php echo Html::anchor('albaran/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>
                    </div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Albarans.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('albaran/create', 'Add new Albaran', array('class' => 'btn btn-success')); ?>

</p>
