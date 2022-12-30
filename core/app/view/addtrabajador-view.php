<?php

if(@count($_POST)>0){

	$cliente = new PersonaData();
	$cliente->tipo_documento = $_POST["tipo_documento"];
	$cliente->documento = $_POST["documento"];
	$cliente->nombre = $_POST["nombre"];


  $direccion="NULL";
  if($_POST["direccion"]!=""){ $direccion=$_POST["direccion"];}

	$cliente->direccion = $direccion;
	$cliente->giro = $_POST["giro"];
 
	$cliente->addTrabajador();

print "<script>window.location='index.php?view=trabajadores';</script>";


}


?>