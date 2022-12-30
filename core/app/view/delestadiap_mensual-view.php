<?php
$eliminar = PagoProcesoData::getById($_GET['id']);
$eliminar->del();
$id=$_GET['id_p'];
	
print "<script>window.location='index.php?view=checkout_mensual&id=$id';</script>";

?>