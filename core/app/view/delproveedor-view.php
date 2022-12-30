<?php


$cliente = PersonaData::getById($_GET["id"]);
$cliente->del();

Core::redir("./index.php?view=proveedores");
?>