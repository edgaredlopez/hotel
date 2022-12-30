<?php
$session_id= session_id(); 
ini_set('date.timezone','America/Lima'); 


$cajas = CajaData::getAllAbierto(); 
 	if(count($cajas)>0){ $id_caja=$cajas->id; 
 	}else{$id_caja='NULL';}



$procesos = ProcesoVentaData::getVenta($_POST['id_venta']);
foreach($procesos as $proceso):
	$venta_proceso = ProcesoVentaData::getById($proceso->id);
	$venta_proceso->id_caja = $id_caja; 
	$venta_proceso->id_tipopago = $_POST['id_tipo_pago'];
	$venta_proceso->updateCreditoCompra();
endforeach;

$venta = VentaData::getById($_POST['id_venta']);
$venta->credito = 0; 
$venta->updateCredito();



print "<script>window.location='index.php?view=compra_credito';</script>";


?>