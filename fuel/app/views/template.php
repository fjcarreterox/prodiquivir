<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<?php echo Asset::css('bootstrap.css'); ?>
    <?php echo Asset::css('styles.css'); ?>
    <?php echo Asset::css('invoice-style.css', array(), null, false); ?>
    <?php echo Asset::css('delivernote-style.css', array(), null, false); ?>
    <?php echo Asset::css('invoice-print.css', array("media"=>"print"), null, false); ?>
    <?php echo Asset::css('delivernote-print.css', array("media"=>"print"), null, false); ?>
    <?php echo Asset::js('jquery.js') ?>
    <?php echo Asset::js('bootstrap.js') ?>
    <?php echo Asset::js('anticipo.js') ?>
    <?php echo Asset::js('invoice.js') ?>
    <?php echo Asset::js('delivernote.js') ?>
    <?php echo Asset::js('main.js') ?>
</head>
<body>
<?php
if(Session::get('username')==""){
    return \Fuel\Core\Response::redirect('/');
}
else{
    $vars=Session::get();
}
?>
<header></header>
	<div class="container">
		<div class="col-md-12 cabecera">
			<!--<h1><?php /*echo $title;*/ ?></h1>-->
			<a alt="Ir al menú principal" href="http://prodi.aceitunascoria.es/fuel/public/" class="no-decoration"><?php echo Asset::img('aceitunas.jpg',array("class"=>"logo","alt"=>"Ir al menú principal")); ?>
				<h1>Prodiquivir S.L.</h1></a>
			<hr>
<?php if (Session::get_flash('success')): ?>
			<div class="alert alert-success">
				<strong>Correcto</strong>
				<p>
				<?php echo implode('</p><p>', e((array) Session::get_flash('success'))); ?>
				</p>
			</div>
<?php endif; ?>
<?php if (Session::get_flash('error')): ?>
			<div class="alert alert-danger">
				<strong>Error</strong>
				<p>
				<?php echo implode('</p><p>', e((array) Session::get_flash('error'))); ?>
				</p>
			</div>
<?php endif; ?>
		</div>
		<div class="col-md-12">
<?php echo $content; ?>
		</div>
		<footer>
			<!--<p class="pull-right"><small><font style="color:red;font-weight:bold">¡En Dinahosting!</font>Contenido cargado en {exec_time}s usando {mem_usage}mb de memoria.</small></p>-->
			<p class="pull-right"><small>Sesión iniciada como <b><?php echo $vars['username'];?></b> en el puesto de recogida de
                    <u><?php echo Model_Puesto::find($vars['puesto'])->get('nombre');?>.</u></small></p>
			<!--<p>
				<a href="http://fuelphp.com">FuelPHP</a> is released under the MIT license.<br>
				Version: <?php /*echo e(Fuel::VERSION);*/ ?></small>
			</p>-->
		</footer>
	</div>
</body>
</html>