<h2>Editando datos del <span class='muted'>albarán</span> seleccionado</h2>
<br/>
<?php echo render('albaran/_form'); ?>
<p><?php echo Html::anchor('albaran/view/'.$albaran->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver datos',array('class'=>'btn btn-default')); ?>&nbsp;
    <?php echo Html::anchor('albaran/list', '<span class="glyphicon glyphicon-backward"></span> Volver',array('class'=>'btn btn-danger')); ?></p>
