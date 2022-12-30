<?php
$session_id= session_id(); 
ini_set('date.timezone','America/Guatemala'); 


$cajas = CajaData::getAllAbierto(); 
 	if(count($cajas)>0){ $id_caja=$cajas->id;
 	}else{$id_caja='NULL';}


$pago = new PagoProcesoData(); 
$pago->monto = $_POST["monto"];
$pago->nro_operacion = '-';
$pago->id_tipopago = $_POST["id_tipo_pago"]; 
$pago->id_proceso = $_POST["id_proceso"]; 
$pago->aval = $_POST["aval"]; 
$pago->id_caja = $id_caja;  
$pago->addPago();

$empresa = ProcesoData::getById($_POST["id_proceso"]);
$empresa->credito = 0;
$empresa->updateCredito();


print "<script>window.location='index.php?view=credito';</script>";


?>