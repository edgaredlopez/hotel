<?php


$cliente = InventaryBedData::getById($_GET["id"]);
$cliente->del();
$id=$_GET['id_c'];

Core::redir("./index.php?view=c_inventario&id=$id");
?>