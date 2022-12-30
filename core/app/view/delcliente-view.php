<?php


$cliente = PersonaData::getById($_GET["id"]);
$cliente->update_estado();

Core::redir("./index.php?view=cliente");
?>