<?php
$session_id= session_id(); 
ini_set('date.timezone','America/Lima'); 

	if(@count($_POST)>0){

 
	

	$cajas = CajaData::getAllAbierto(); 
 	if(@count($cajas)>0){ $id_caja=$cajas->id;
 	}else{$id_caja='NULL';}
 

 $clientes = PersonaData::getLikeDni($_POST["documento"]);
  if(@count($clientes)>0){
    $id_cliente=$clientes->id;

    $cliente = PersonaData::getById($id_cliente);

      $cliente->tipo_documento = $_POST["tipo_documento"];
      $cliente->documento = $_POST["documento"];
      $cliente->nombre = $_POST["nombre"]; 
      $cliente->giro = $_POST["giro"]; 

      $direccion="NULL";
        if($_POST["direccion"]!=""){ $direccion=$_POST["direccion"];}
      $cliente->direccion = $direccion;

      $nacionalidad="NULL";
        if($_POST["nacionalidad"]!=""){ $nacionalidad=$_POST["nacionalidad"];}
      $cliente->nacionalidad = $nacionalidad;

      $estado_civil="NULL";
        if($_POST["estado_civil"]!=""){ $estado_civil=$_POST["estado_civil"];}
      $cliente->estado_civil = $estado_civil;

      $ocupacion="NULL";
        if($_POST["ocupacion"]!=""){ $ocupacion=$_POST["ocupacion"];}
      $cliente->ocupacion = $ocupacion;

      $medio_transporte="NULL";
        if($_POST["medio_transporte"]!=""){ $medio_transporte=$_POST["medio_transporte"];}
      $cliente->medio_transporte = $medio_transporte;

      $destino="NULL";
        if($_POST["destino"]!=""){ $destino=$_POST["destino"];}
      $cliente->destino = $destino;

      $motivo="NULL";
        if($_POST["motivo"]!=""){ $motivo=$_POST["motivo"];}
      $cliente->motivo = $motivo;

      $cliente->updateclienteProceso(); 
      $id_clientee=$clientes->id;
    

  }else{
    $cliente = new PersonaData();
      $cliente->tipo_documento = $_POST["tipo_documento"];
      $cliente->documento = $_POST["documento"];
      $cliente->nombre = $_POST["nombre"]; 
      $cliente->giro = $_POST["giro"]; 

      $direccion="NULL";
        if($_POST["direccion"]!=""){ $direccion=$_POST["direccion"];}
      $cliente->direccion = $direccion;

      $nacionalidad="NULL";
        if($_POST["nacionalidad"]!=""){ $nacionalidad=$_POST["nacionalidad"];}
      $cliente->nacionalidad = $nacionalidad;

      $estado_civil="NULL";
        if($_POST["estado_civil"]!=""){ $estado_civil=$_POST["estado_civil"];}
      $cliente->estado_civil = $estado_civil;

      $ocupacion="NULL";
        if($_POST["ocupacion"]!=""){ $ocupacion=$_POST["ocupacion"];}
      $cliente->ocupacion = $ocupacion;

      $medio_transporte="NULL";
        if($_POST["medio_transporte"]!=""){ $medio_transporte=$_POST["medio_transporte"];}
      $cliente->medio_transporte = $medio_transporte;

      $destino="NULL";
        if($_POST["destino"]!=""){ $destino=$_POST["destino"];}
      $cliente->destino = $destino;

      $motivo="NULL";
        if($_POST["motivo"]!=""){ $motivo=$_POST["motivo"];}
      $cliente->motivo = $motivo;

      $s = $cliente->add(); 
      $id_clientee=$s[1];

   
  }


 	
 	

       

	$habitacion = HabitacionData::getById($_POST["id_habitacion"]);
	$habitacion->estado = 2;
	$habitacion->updateEstado();
   

   $proceso1 = ProcesoData::getById($_POST["id_procesoo"]);
  


	$proceso = new ProcesoData();
	$proceso->id_habitacion = $_POST["id_habitacion"];
	$proceso->id_tarifa = $_POST["id_tarifa"];
	$proceso->id_cliente = $id_clientee;

	$proceso->precio = $_POST["precio"]; 
	
	
	$proceso->cant_noche = $_POST["cant_noche"];
	$proceso->dinero_dejado = $_POST["monto"];
	$proceso->fecha_entrada = date('Y-m-j H:i:s');
	$proceso->fecha_salida = $_POST["fecha_salida"].' '.$_POST['hora_salida'];
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
  $proceso->id_tipo_pago = $_POST["id_tipo_pago"];
  $proceso->fecha_creada = $proceso1->fecha_creada;  
  
	$f=$proceso->addIngresoRe();

  $proceso1->del(); 

  $pago = new PagoProcesoData();
  $pago->monto = $_POST["monto"];
  $pago->nro_operacion = $_POST["nro_operacion"];
  $pago->id_tipopago = $_POST["id_tipo_pago"]; 
  $pago->id_proceso = $f[1]; 
  $pago->id_caja=$id_caja;
  $pago->add();



	$cliente_proceso = new ClienteProcesoData();
      $cliente_proceso->id_cliente=$id_clientee;
      $cliente_proceso->sesion=$session_id;
      $cliente_proceso->id_proceso=$f[1]; 
      $cliente_proceso->add(); 

	




print "<script>window.location='index.php?view=recepcion';</script>";


}else{
	 	
	 	echo "<script>alert('NO SE AGREGÓ NINGÚN CLIENTE. FAVOR DE INGRESAR');</script>";
	 	print "<script>window.location='index.php?view=recepcion';</script>";

	 
}

?>