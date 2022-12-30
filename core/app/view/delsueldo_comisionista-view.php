<?php


$esperado = ProcesoPagoComisionistaData::getById($_GET["id"]);
$esperado->del();

$id=$_GET["id_su"];
$start=$_GET['start'];
$end=$_GET['end'];

Core::redir("./index.php?view=proceso_sueldo_comision&id=$id&start=$start&end=$end");
?> 