<?php if(empty($year)){
?>
    <h2>Datos históricos de <span class='muted'>campañas pasadas.</span></h2>
    <br/>
    <p>A continuación selecciona el año que deseas consultar:</p>
    <ul>
        <li><a href="../entrega/historico/2015">Campaña 2015</a></li>
        <li><a href="../entrega/historico/2016">Campaña 2016</a></li>
    </ul>
<?php
}
else {
    ?>

    <h2>Datos históricos de la <span class='muted'>campaña de <?php echo $year; ?></span></h2>
    <br/>
    <p>A continuación puedes consultar todos los datos relevantes de la pasada campaña de <?php echo $year;?>.</p>
    <ul>
        <li><a href="../entrega/year/<?php echo $year;?>">Entregas</a></li>
        <li><a href="../albaran/year/<?php echo $year;?>">Albaranes</a></li>
        <li><a href="../factura/year/<?php echo $year;?>">Facturas</a></li>
        <li><a href="../anticipo/year/<?php echo $year;?>">Anticipos</a></li>
        <li><a href="../factura/gestoria/<?php echo $year;?>">Resumen para gestoria</a></li>
        <li><a href="../factura/report/<?php echo $year;?>">Resumen IVA y retenciones</a></li>
    </ul>

    <?php
}?>