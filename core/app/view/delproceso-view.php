<?php

if(@count($_GET)>0){ 
 


	$proceso = ProcesoData::getById($_GET["id"]);
	$proceso->del();   

	$habitacion = HabitacionData::getById($_GET["id_habitacion"]);
	$habitacion->estado = 3;
	$habitacion->updateEstado(); 

 
    $productos = ProcesoVentaData::getByAll($_GET['id']);
    foreach($productos as $del):
		$eliminar = ProcesoVentaData::getById($del->id);
		$eliminar->del();
	endforeach;



  print "<script>window.location='index.php?view=recepcion';</script>";



}

?>