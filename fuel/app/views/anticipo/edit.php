<h2>Editando el <span class='muted'>anticipo</span> seleccionado:</h2>
<br>
<?php
$data['bancos']=$bancos;
echo render('anticipo/_form',$data); ?>
<p>
<?php echo Html::anchor('anticipo/view/'.$anticipo->id, 'Ver detalle'); ?> |
<?php echo Html::anchor('anticipo/list', 'Volver'); ?></p>
