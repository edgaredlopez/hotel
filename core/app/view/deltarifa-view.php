<?php


$cliente = TarifaData::getById($_GET["id"]);
$cliente->update_estado();

Core::redir("./index.php?view=tarifa");
?>