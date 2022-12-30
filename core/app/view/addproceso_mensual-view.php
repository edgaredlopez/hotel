<?php
$session_id= session_id(); 
ini_set('date.timezone','America/Guatemala'); 

if(@count($_POST)>0){

 
	

	$cajas = CajaData::getAllAbierto(); 
 	if(@count($cajas)>0){ $id_caja=$cajas->id;
 	}else{$id_caja='NULL';}
 

  $id_cliente=$_POST["id_cliente"];

	$habitacion = HabitacionData::getById($_POST["id_habitacion"]);
	$habitacion->estado = 2;
	$habitacion->updateEstado();
  

	$proceso = new ProcesoData();
	$proceso->tipo_servicio = $_POST["tipo_servicio"];
	$proceso->id_habitacion = $_POST["id_habitacion"];
	$proceso->id_tarifa = $_POST["id_tarifa"];
	$proceso->id_cliente = $id_cliente;

	$proceso->precio = $_POST["precio"]; 
	
	
	$proceso->cant_noche = 1;
	$proceso->dinero_dejado = 0;
	$proceso->fecha_entrada = $_POST["fecha_entrada"].' 12:00:00 ';

    $nuevafecha = strtotime ( '+1 month' , strtotime ( $_POST["fecha_entrada"] ) ) ;
    $nuevafecha = date ( 'Y-m-j' , $nuevafecha );

	$proceso->fecha_salida = $nuevafecha.' 12:00:00';
	$proceso->id_usuario = $_SESSION["user_id"];
	$proceso->cant_personas = 1;
	$proceso->id_caja = $id_caja;
	$proceso->cantidad = $_POST["cantidad"];
	$proceso->pagado = $_POST["pagado"];
  $proceso->extra = $_POST["extra"];
  $proceso->tarjeta_e = $_POST["tarjeta_e"];
  $proceso->observacion = $_POST["observacion"];
  $proceso->nro_folio = $_POST["nro_folio"];
  $proceso->comprobante = $_POST["comprobante"];
  $id_tipo_pago=1;
  if(isset($_POST["id_tipo_pago"]) and $_POST["id_tipo_pago"]!=''){ $id_tipo_pago=$_POST["id_tipo_pago"];}
  $proceso->id_tipo_pago = $id_tipo_pago; 
  $proceso->id_comisionista = $_POST["id_comisionista"]; 

	$f=$proceso->addIngresoMensual();

  $pago = new PagoProcesoData();
  $pago->monto = $_POST["precio"];
  $pago->nro_operacion = "NULL";
  $pago->id_tipopago = $_POST["id_tipo_pago"]; 
  $pago->id_proceso = $f[1]; 
  $pago->id_caja=$id_caja;
  $pago->pagado=$_POST["pagado"];
  $pago->addMensual();



	$cliente_proceso = new ClienteProcesoData();
      $cliente_proceso->id_cliente=$id_cliente;
      $cliente_proceso->sesion=$session_id;
      $cliente_proceso->id_proceso=$f[1]; 
      $cliente_proceso->add(); 

	




print "<script>window.location='index.php?view=tablero_mensual';</script>";


}else{
	 	
	 	echo "<script>alert('NO SE AGREGÓ NINGÚN CLIENTE. FAVOR DE INGRESAR');</script>";
	 	print "<script>window.location='index.php?view=recepcion';</script>";

	 
}

?>