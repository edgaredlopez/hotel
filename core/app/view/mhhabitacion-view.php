<?php

if(@count($_GET)>0){

	$habitacion = HabitacionData::getById($_GET['id']);
	$habitacion->estado = 1;

	$habitacion->updateEstado();
 
	$historial = HistorialMantenimientoData::getByIdHab($_GET['id']);
	$historial->update_fecha();

print "<script>window.location='index.php?view=habitacion';</script>";


}


?>