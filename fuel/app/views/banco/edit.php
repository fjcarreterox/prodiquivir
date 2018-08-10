<h2>Editando el <span class='muted'>banco</span> seleccionado:</h2>
<br/>
<?php echo render('banco/_form'); ?>
<p><?php echo Html::anchor('banco/view/'.$banco->id, 'Ver Ficha',array('class'=>'btn btn-default')); ?>&nbsp;
    <?php echo Html::anchor('banco', 'Volver al listado',array('class'=>'btn btn-danger')); ?></p>
