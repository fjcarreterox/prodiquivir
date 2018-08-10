<?php
$nombre=Model_Proveedor::find(\Fuel\Core\Session::get('ses_anticipo_prov'))->get('nombre');
$data['bancos']=$bancos;
$data['cuantia'] =\Fuel\Core\Session::get('ses_anticipo_cuantia');
$data['nombre_prov']=$nombre;
?>
<h2>Registrar un nuevo <span class='muted'>anticipo</span> en el sistema para <strong><?php echo $nombre;?></strong>:</h2>
<br>
<?php echo render('anticipo/_form',$data); ?>
<p><?php echo Html::anchor('anticipo', '<span class="glyphicon glyphicon-backward"></span> Volver',array('class'=>'btn btn-danger')); ?></p>
