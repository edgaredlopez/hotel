<?php
date_default_timezone_set('America/Lima');
$hoy = date("Y-m-d");
$hora = date("H:i:s");
$fecha_completo = date("Y-m-d H:i:s");   
             
if(@count($_POST)>0){

  $id_ope=$_POST['id_operacion'];
	$cajas = CajaData::getAllAbierto(); 
 	if(@count($cajas)>0){ $id_caja=$cajas->id;
 	}else{$id_caja='NULL';}


  $sumatoria=0; 
  $tmps = PagoProcesoData::getAllProceso($_POST['id_operacion']); 
  foreach($tmps as $p):
    $sumatoria=$sumatoria+$p->monto;
  endforeach; 
  

	$proceso = ProcesoData::getById($_POST["id_operacion"]);
	$proceso->total = $_POST['total_resumen'];
  $proceso->id_tipo_pago = $_POST['id_tipo_pago'];
  $proceso->extra=0;
  $proceso->fecha_salida = $fecha_completo;
  $descuento=0;
  if(isset($_POST['descuento']) and $_POST['descuento']!='' and $_POST['descuento']<=100 and $_POST['descuento']>=0){
    $descuento=$_POST['descuento'];
  }else{
    $descuento=0;
  }
  $proceso->descuento = $descuento;
	$proceso->updateSalida();  

  $tipocomprobante = TipoComprobanteData::getById($_POST['comprobante']);

  $cadena=substr($tipocomprobante->nombre,0,1);
 
  $procesocod = ProcesoData::getUltimoProcess($_POST['comprobante']);
  $codigo=0;
  if(count($procesocod)>0){
    if(count($procesocod)<10){
      $codigo=$cadena.'-00000'.(count($procesocod)+1);
    }else if($procesocod->id<100){
      $codigo=$cadena.'-0000'.(count($procesocod)+1);
    }else if($procesocod->id<1000){
      $codigo=$cadena.'-000'.(count($procesocod)+1);
    }else if($procesocod->id<10000){
      $codigo=$cadena.'-00'.(count($procesocod)+1);
    }else if($procesocod->id<100000){
      $codigo=$cadena.'-0'.(count($procesocod)+1);
    }else if($procesocod->id<1000000){
      $codigo=$cadena.'-'.(count($procesocod)+1);
    }else{
      $codigo=$cadena.'-'.(count($procesocod)+1);
    }

  }else{$codigo=$cadena.'-000001';}


                  


  $voucher = ProcesoData::getById($_POST["id_operacion"]);
  $voucher->comprobante = $_POST['comprobante'];
  $voucher->nro_folio = $codigo;
  $voucher->updateVoucher();


	$habitacion = HabitacionData::getById($proceso->id_habitacion);
	$habitacion->estado = 3;
	$habitacion->updateEstado(); 


  $pago = new PagoProcesoData();
  if((($proceso->precio*$proceso->cant_noche)-$sumatoria)>=0){
    $total_queda=($proceso->precio*$proceso->cant_noche)-$sumatoria;
  }else{
    $total_queda=0;
  }
  $pago->monto = $total_queda; 
  $pago->nro_operacion = $_POST["nro_operacion"];
  $pago->id_tipopago = $_POST["id_tipo_pago"]; 
  $pago->id_proceso = $_POST["id_operacion"];
  $pago->id_caja = $id_caja;
  $pago->add();


  $productos = ProcesoVentaData::getByAll($_POST['id_operacion']);
    if(@count($productos)>0){             
    foreach($productos as $producto):
    if($producto->fecha_creada!=NULL and $producto->fecha_creada!="0000-00-00 00:00:00"){ 

    }else{ 
    $venta = ProcesoVentaData::getById($producto->id);
    $venta->fecha_creada = $_POST['fecha_salida'];
    $venta->id_tipopago = $_POST["id_tipo_pago"];
    $venta->updateFecha(); 
    };                   
    endforeach;  
    }else{  
           

    };
  

  $procesos_lista = PagoProcesoData::getAllProcesoTodo($_POST['id_operacion']);
    if(@count($procesos_lista)>0){             
    foreach($procesos_lista as $procesos_list):
    $p_lista = PagoProcesoData::getById($procesos_list->id);
    $p_lista->id_tipopago = $_POST["id_tipo_pago"];
    $p_lista->pagado = 1; 
    $p_lista->updateSalida();

    endforeach;  
    };

 
    $ingresos_lista = GastoData::getAllIngresoProceso($_POST['id_operacion']);
    if(@count($ingresos_lista)>0){             
    foreach($ingresos_lista as $ingresos_list):
    $ingreso = GastoData::getById($ingresos_list->id);
    $ingreso->id_caja = $id_caja;
    $ingreso->id_tipopago = $_POST["id_tipo_pago"];
    $ingreso->updateSalida();

    endforeach;  
    };



    
if(isset($_POST['boleta'])) 
{ 
  print "<script>window.location='index.php?view=imprimir_boleta&id=$id_ope';</script>";
} 
else if(isset($_POST['factura'])) 
{ 
  print "<script>window.location='index.php?view=imprimir_factura&id=$id_ope';</script>";
}else if(isset($_POST['ticket'])) 
{ 
  print "<script>window.location='index.php?view=imprimir_ticket&id=$id_ope';</script>";
}else if(isset($_POST['general'])) 
{ 
  print "<script>window.location='index.php?view=imprimir_f&id=$id_ope';</script>";
}



}

?>