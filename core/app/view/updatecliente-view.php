<?php
 
if(@count($_POST)>0){ 

	$cliente = PersonaData::getById($_POST["id_cliente"]);
	$cliente->tipo_documento = $_POST["tipo_documento"];
	$cliente->documento = $_POST["documento"];
	$cliente->nombre = $_POST["nombre"];

	$estado_civil="NULL";
  if($_POST["estado_civil"]!=""){ $estado_civil=$_POST["estado_civil"];}

  $giro="NULL";
  if($_POST["giro"]!=""){ $giro=$_POST["giro"];}

  $direccion="NULL";
  if($_POST["direccion"]!=""){ $direccion=$_POST["direccion"];}

  $fecha_nac="";

  $motivo="";
  if($_POST["motivo"]!=""){ $motivo=$_POST["motivo"];}


$medio_transporte="NULL";
  if($_POST["medio_transporte"]!=""){ $medio_transporte=$_POST["medio_transporte"];}

	$cliente->medio_transporte = $medio_transporte; 

	$cliente->estado_civil = $estado_civil;
	
	$cliente->direccion = $direccion;
	$cliente->fecha_nac = $fecha_nac;
	$cliente->motivo = $motivo;
	$cliente->giro = $giro;

	$cliente->updateclienteProceso();

print "<script>window.location='index.php?view=cliente';</script>";


}


?>