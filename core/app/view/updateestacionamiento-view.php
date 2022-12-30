<?php

if(@count($_POST)>0){

	$habitacion = ProcesoData::getById($_POST["id_proceso"]);
	
	$habitacion->tarjeta_e = $_POST['tarjeta_e'];
	$habitacion->updateEstacionamiento();

	$id=$_POST["id_proceso"];

print "<script>window.location='index.php?view=proceso_salida&id=$id';</script>";


}

?>