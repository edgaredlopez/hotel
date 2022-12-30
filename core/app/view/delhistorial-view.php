<?php


$historial = HistorialMantenimientoData::getById($_GET["id"]);
$historial->del();

Core::redir("./index.php?view=habitacion");
?>