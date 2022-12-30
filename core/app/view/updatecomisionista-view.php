<?php

if(@count($_POST)>0){

	$comisionista = ComisionistaData::getById($_POST["id_comisionista"]);
	$comisionista->nombre = $_POST["nombre"];
	$comisionista->porcentaje = $_POST["porcentaje"];
	 
	$detalle="NULL";
  if($_POST["detalle"]!=""){ $detalle=$_POST["detalle"];}

  

	$comisionista->detalle = $detalle;  

	$comisionista->update();


print "<script>window.location='index.php?view=comisionista';</script>";


}


?>