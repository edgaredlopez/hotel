<?php

if(@count($_POST)>0){

	$habitacion = HabitacionData::getById($_POST["id_habitacion"]);
	
	$habitacion->estado = $_POST['estado'];
	$habitacion->updateEstado();

print "<script>window.location='index.php?view=recepcion';</script>";


}

?>