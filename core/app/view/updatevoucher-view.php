<?php

if(@count($_POST)>0){

	$habitacion = ProcesoData::getById($_POST["id_proceso"]);
	
	$habitacion->comprobante = $_POST['comprobante'];
	$habitacion->nro_folio = $_POST['nro_folio'];
	$habitacion->updateVoucher();

	$id=$_POST["id_proceso"];

print "<script>window.location='index.php?view=proceso_salida&id=$id';</script>";


}

?>