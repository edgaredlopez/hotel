<?php


$habi = ProductoData::getById($_GET["id"]);
$habi->del();

$dels = ProcesoVentaData::getProcesoProductoo($_GET['id']);
	foreach($dels as $del):
		$eliminar = ProcesoVentaData::getById($del->id);
		$eliminar->del();
	endforeach;


$id=$_GET["id_c"];
print "<script>window.location='index.php?view=c_productos&id=$id';</script>";
?>