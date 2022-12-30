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



// DATOS ADICIONALES 
  $razon_social="NULL";
  if($_POST["razon_social"]!=""){ $razon_social=$_POST["razon_social"];}

  $nacionalidad="NULL";
  if($_POST["nacionalidad"]!=""){ $nacionalidad=$_POST["nacionalidad"];}

  $ocupacion="NULL";
  if($_POST["ocupacion"]!=""){ $ocupacion=$_POST["ocupacion"];}

  $destino="NULL";
  if($_POST["destino"]!=""){ $destino=$_POST["destino"];}

  $telefono="NULL";
  if($_POST["telefono"]!=""){ $telefono=$_POST["telefono"];}

  $celular="NULL";
  if($_POST["celular"]!=""){ $celular=$_POST["celular"];}

  $alergia="NULL";
  if($_POST["alergia"]!=""){ $alergia=$_POST["alergia"];}

	$cliente->medio_transporte = $medio_transporte; 
	$cliente->estado_civil = $estado_civil;
	$cliente->direccion = $direccion;
	$cliente->fecha_nac = $fecha_nac;
	$cliente->motivo = $motivo;
	$cliente->giro = $giro;

	// DATOS ADICIONALES
	$cliente->razon_social = $razon_social;
	$cliente->nacionalidad = $nacionalidad;
	$cliente->ocupacion = $ocupacion;
	$cliente->destino = $destino;
	$cliente->telefono = $telefono;
	$cliente->celular = $celular;
	$cliente->alergia = $alergia;

	$cliente->updateclienteResidente();

print "<script>window.location='index.php?view=cliente_residente';</script>";


}


?>