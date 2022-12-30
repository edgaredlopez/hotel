<?php
date_default_timezone_set('America/Guatemala');
$hoy = date("Y-m-d");
$hora = date("H:i:s");
$fecha_completo = date("Y-m-d H:i:s");   
             
 
  
if(@count($_POST)>0){

  $id_ope=$_POST['id_proceso'];
	$cajas = CajaData::getAllAbierto(); 
 	if(@count($cajas)>0){ $id_caja=$cajas->id;
 	}else{$id_caja='NULL';}



  $pago = new PagoProcesoData();
  $pago->monto = $_POST["precio"];
  $pago->nro_operacion = "-"; 
  $pago->id_proceso = $_POST["id_proceso"];
  $pago->cantidad = $_POST["cant_noche"];

  $fecha_actual = $_POST["fecha_salida"];
  //sumo 1 día
  $fecha_salida = date("Y-m-d",strtotime($fecha_actual."+ ".$_POST['cant_noche']." days")); 

  $pago->fecha_entrada = $fecha_actual;
  $pago->fecha_salida = $fecha_salida.' 12:00:00';
  $pago->id_caja = $id_caja;
  $pago->addEstadia();


  print "<script>window.location='index.php?view=addprocesoprueba&id=$id_ope';</script>";          

};

?>