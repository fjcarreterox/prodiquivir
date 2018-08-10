<?php
    echo Form::open(array("class" => "form-horizontal"));
    echo "<h2 > Selecciona un rango de fechas para obtener el listado de entregas de <b>".Model_Puesto::find($idpuesto)->get('nombre')."</b></h2 >";
?>
<br/>
<p class="hide_elem">Para obtener resultados de entregas, asegúrate de que la <b>fecha final</b> es posterior a la <b>inicial</b>.</p>
<br/>
    <fieldset class="hide_elem">
        <div class="form-group">
            <?php echo Form::label('Fecha inicial', 'start', array('class'=>'control-label')); ?>
            <?php echo Form::input('start', '', array('type'=>'date','class' => 'col-md-4 form-control')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Fecha final', 'end', array('class'=>'control-label')); ?>
            <?php echo Form::input('end', '', array('type'=>'date','class' => 'col-md-4 form-control')); ?>
        </div>
        <br/>
        <div class="form-group">
            <label class='control-label'>&nbsp;</label>
            <?php echo Form::button('submit', '<span class="glyphicon glyphicon-ok"></span> Consultar entrada diaria', array('class' => 'btn btn-primary','type'=>'submit')); ?>
        </div>
    </fieldset>
    <?php echo Form::close();
    if(count($entregas)>0):
        echo Html::anchor('javascript:window.print()', '<span class="glyphicon glyphicon-print"></span> Imprimir entradas', array('class' => 'btn btn-small btn-info','id'=>'print-invoice'));
        echo "<br/><br/><p>Mostrando listado de entregas realizadas entre el <b>".date_conv($_POST["start"])."</b> y el <b>".date_conv($_POST["end"])."</b>.</p>";
        echo "<br/><p>Total de entregas encontradas: <b>".count($entregas)."</b></p>";
    ?>
<br/>
	<h3 class="print"><u>Listado detallado de entregas encontradas</u></h3>
    <table class="table table-striped print">
    <thead>
    <tr>
        <th>Fecha entrega</th>
        <th>Proveedor</th>
        <th>NIF/CIF</th>
        <th>Núm. Albarán</th>
        <th>Variedad</th>
        <th>Total Kg</th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    <?php $total = array();
			foreach ($entregas as $item):?>
    <tr>
        <td><?php echo date_conv($item->fecha); ?></td>
        <td><?php echo Model_Proveedor::find(Model_Albaran::find('first', array('where' => array('id' => $item->albaran)))->get('idproveedor'))->get('nombre'); ?></td>
        <td><?php echo Model_Proveedor::find(Model_Albaran::find('first', array('where' => array('id' => $item->albaran)))->get('idproveedor'))->get('nifcif'); ?></td>
        <td><?php echo Model_Albaran::find($item->albaran)->get('idalbaran'); ?></td>
        <td><?php 
			$v = $item->variedad;
			echo Model_Variedad::find($v)->get('nombre');?></td>
        <td><?php echo $item->total; 
                if(!isset($total[$v])){
                    $total[$v] = $item->total;
                }else{
                    $total[$v] += $item->total;
                }
		?></td>
        <td>
            <div class="btn-toolbar">
                <div class="btn-group">
                    <?php echo Html::anchor('entrega/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver detalle', array('class' => 'btn btn-small btn-default')); ?>
                </div>
            </div>

        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
    </table>
		<br/>

    <h3 class="print"><u>Resumen de kg. entregados por variedad de aceituna</u></h3>
    <table class="table table-striped print">
        <thead>
        <tr>
            <th>Variedad</th>
            <th>Total entregado</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($total as $v => $t): ?>
            <tr>
                <td><?php echo Model_Variedad::find($v)->get('nombre'); ?></td>
                <td><?php echo $t; ?>  Kgs.</td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <br/>
		
        <?php else: ?>
            <?php if(isset($_POST["submit"])):?>
        <p>No se han encontrado entregas en el intervalo de tiempo especificado. Prueba con otras fechas.</p>
            <?php endif; ?>
    <?php endif; ?>
