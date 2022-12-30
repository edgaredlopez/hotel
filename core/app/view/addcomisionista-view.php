<?php

if(@count($_POST)>0){

	$comisionista = new ComisionistaData();
	$comisionista->nombre = $_POST["nombre"];
	$comisionista->porcentaje = $_POST["porcentaje"];

	$detalle="NULL";
  if($_POST["detalle"]!=""){ $detalle=$_POST["detalle"];}

  
	$comisionista->detalle = $detalle;
 
	$comisionista->add();

print "<script>window.location='index.php?view=comisionista';</script>";


}


?>