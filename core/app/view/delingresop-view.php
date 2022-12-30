<?php
$eliminar = GastoData::getById($_GET['id']);
$eliminar->del();
$id=$_GET['id_p'];
	
print "<script>window.location='index.php?view=addprocesoprueba&id=$id';</script>";

?>