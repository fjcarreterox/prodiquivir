<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Prodiquivir S.L.U.</title>
	<?php echo Asset::css('bootstrap.css'); ?>
    <?php echo Asset::css('styles.css'); ?>
</head>
<body>
	<header>
		<div class="container">
			<div id="logo"></div>
		</div>
	</header>
	<div class="container">
		<div class="jumbotron">
			<h1>Prodiquivir S.L.U.</h1>
			<br/>
			<p>Área de gestión. ¡Qué tal, <b><?php echo \Fuel\Core\Session::get('username'); ?></b>!</p><br/>
            <ul class="list-unstyled">
                <li><small><a href="welcome/guide" class="btn btn-info"><span class="glyphicon glyphicon-book"></span> &nbsp;Guía de uso básico de la aplicación</a></small></li>
                <li><small><a href="http://www.aceitunascoria.es" target="_blank" class="btn btn-default">Visitar la web corporativa &nbsp;<span class="glyphicon glyphicon-globe"></span></a></small></li>
                <li><small><a href="logout" class="btn btn-danger">Salir del sistema &nbsp;<span class="glyphicon glyphicon-log-out"></span></a></small></li>
            </ul>
		</div>
        <div class="row">
            <div class="col-md-4">
                <h2>Acciones más frecuentes</h2>
                <ul>
                    <li><a href="entrega/create">Registrar nueva entrega</a></li>
                    <li><a href="puesto">Entrada diaria</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h2>Entregas y albaranes</h2>
                <ul>
                    <li><a href="entrega/list">Listado completo de entregas</a></li>
                    <li><a href="albaran/list">Listado completo de albaranes</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h2>Informes</h2>
                <li><a href="entrega/init">Ficha final del proveedor</a></li>
				<li><a href="proveedor/activos">Proveedores activos</a></li>
                <li><a href="proveedor/inactivos">Proveedores inactivos</a></li>
				<li><a href="proveedor/liquidados">Proveedores liquidados</a></li>
				<li><a href="entrega/historico">Histórico de campañas anteriores</a></li>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h2>Anticipos</h2>
                <ul>
                    <li><a href="anticipo">Cálculo de anticipos</a></li>
                    <li><a href="anticipo/list">Resumen de anticipos</a></li>
                    <li><a href="anticipo/init">Anticipos por proveedor</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h2>Facturación</h2>
                <ul>
                    <li><a href="factura/create">Generar nueva factura</a></li>
                    <li><a href="factura/list">Ver todas las facturas hasta la fecha</a></li>
                    <li><a href="factura/init">Facturas emitidas por proveedor</a></li>
					<li><a href="factura/report">Resumen IVA y retenciones</a></li>
					<li><a href="factura/gestoria">Resumen para gestoría</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h2>Gestión de esta aplicación</h2>
                <li><a href="proveedor">Listado de proveedores</a></li>
                <li><a href="variedad">Variedades de aceitunas</a></li>
                <li><a href="user">Usuarios del sistema</a></li>
                <li><a href="puesto">Puestos de la empresa</a></li>
                <li><a href="banco">Bancos con los que trabajamos</a></li>
            </div>
        </div>
		<hr/>
		<footer>
            <p class="pull-right"><small>Developed and designed with love by <a href="mailto:rentonr11@gmail.com">jaxxrenton</a>.</small></p>
            <!--<p class="pull-right">COntenido cargado en {exec_time}s usando {mem_usage}mb de memoria.</p>
			<p>
				<a href="http://fuelphp.com">FuelPHP</a> is released under the MIT license.<br>
				<small>Version: <?php echo Fuel::VERSION; ?></small>
			</p>-->
		</footer>
	</div>
</body>
</html>
