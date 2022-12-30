<?php
$user = UserData::getById($_POST["user_id"]);
	$reserva=0;
	if(isset($_POST["reserva"])){$reserva=1;} 
	$recepcion=0;
	if(isset($_POST["recepcion"])){$recepcion=1;} 
	$factura=0;
	if(isset($_POST["factura"])){$factura=1;} 
	$credito=0;
	if(isset($_POST["credito"])){$credito=1;} 
	$punto_venta=0;
	if(isset($_POST["punto_venta"])){$punto_venta=1;} 
	$inventario=0;
	if(isset($_POST["inventario"])){$inventario=1;} 
	$caja=0;
	if(isset($_POST["caja"])){$caja=1;} 
	$egreso=0;
	if(isset($_POST["egreso"])){$egreso=1;} 
	$configuracion=0;
	if(isset($_POST["configuracion"])){$configuracion=1;} 
	$cliente=0;
	if(isset($_POST["cliente"])){$cliente=1;} 
	$reporte=0;
	if(isset($_POST["reporte"])){$reporte=1;} 
	$administracion=0;
	if(isset($_POST["administracion"])){$administracion=1;} 
	$servicio=0;
	if(isset($_POST["servicio"])){$servicio=1;} 
	$kiosko=0;
	if(isset($_POST["kiosko"])){$kiosko=1;} 

	$cocina=0;
	if(isset($_POST["cocina"])){$cocina=1;} 
	$lavadero=0;
	if(isset($_POST["lavadero"])){$lavadero=1;} 
	
	$user->reserva=$reserva;
	$user->recepcion=$recepcion;
	$user->factura=$factura;
	$user->credito=$credito;
	$user->punto_venta=$punto_venta;
	$user->inventario=$inventario;
	$user->caja=$caja;
	$user->egreso=$egreso;
	$user->configuracion=$configuracion;
	$user->cliente=$cliente;
	$user->reporte=$reporte;
	$user->administracion=$administracion;
	$user->servicio=$servicio;
	$user->kiosko=$kiosko;
	$user->cocina=$cocina;
	$user->lavadero=$lavadero;
	$user->updateNivel();

print "<script>window.location='index.php?view=users';</script>";





?>