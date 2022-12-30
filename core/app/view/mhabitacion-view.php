<?php

if(@count($_POST)>0){
 
	$habitacion = HabitacionData::getById($_POST['id_habitacion']);
	$habitacion->estado = 4;
	$habitacion->updateEstado();

 
	$historial = new HistorialMantenimientoData();
	$historial->id_habitacion = $_POST["id_habitacion"];
	$historial->detalle = $_POST["detalle"];
	$historial->costo = $_POST["costo"];
	$historial->fecha = $_POST["fecha"];
	$historial->add();

	$id=$_POST['id_habitacion'];

print "<script>window.location='index.php?view=historial_habitacion&id=$id';</script>";


}
 

?>