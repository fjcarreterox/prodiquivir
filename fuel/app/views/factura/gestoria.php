<h2>Listado de <span class='muted'>facturas</span> emitidas <?php echo $titulo; ?> para la gestoría</h2>
<br/>
<?php if ($facturas): ?>
    <br/>
<table class="table table-striped print">
	<thead>
		<tr>
            <th>Nº Factura</th>
            <?php if ($titulo=="") {
                echo "<th>Proveedor</th>";
                echo "<th>CIF/NIF</th>";
            }?>
			<th>Base (&euro;)</th>
			<th>Retención (2%)</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($facturas as $f): ?>		<tr>
            <td><?php echo $f['num']; ?></td>
            <?php if ($titulo=="") {
			echo "<td>".Model_Proveedor::find($f['prov'])->get('nombre')."</td>";
			echo "<td>".Model_Proveedor::find($f['prov'])->get('nifcif')."</td>";
            }?>
            <td><?php echo $f['base']+$f['comp']; ?></td>
            <td><?php echo $f['retencion']; ?></td>
		</tr>
<?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>
    <p>No se han encontrado facturas hasta ahora.</p>
<?php endif; 
echo Html::anchor('javascript:window.print()', '<span class="glyphicon glyphicon-print"></span> Imprimir listado', array('class' => 'btn btn-small btn-info','id'=>'print-invoice'));
?>