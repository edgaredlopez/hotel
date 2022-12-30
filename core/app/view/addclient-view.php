<?php
if(@count($_POST)>0){

$clientes = PersonaData::getLikeDni($_POST["documento"]);
if(@count($clientes)>0){

  
print "<script>alert('El cliente ya está registrado');</script>";
print "<script>window.location='index.php?view=cliente';</script>";

}
else
{


	$cliente = new PersonaData();

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


	$cliente->estado_civil = $estado_civil;
	
	$cliente->direccion = $direccion;
	$cliente->fecha_nac = $fecha_nac;
	$cliente->motivo = $motivo; 
	$cliente->giro = $giro; 
	$cliente->medio_transporte = $medio_transporte; 
 
	$cliente->addClientenuevo();

   
   
}


	
print "<script>window.location='index.php?view=cliente';</script>";


}


?>