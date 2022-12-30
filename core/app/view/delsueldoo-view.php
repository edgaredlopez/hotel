<?php


$cliente = SueldoData::getById($_GET["id"]);
$cliente->del(); 

$trabajador = PersonaData::getById($_GET["id_t"]);
$trabajador->update_del();

Core::redir("./index.php?view=sueldo");
?>