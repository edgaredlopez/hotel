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


 	
 
  

	$reserva = new ReservapData();
	$reserva->id_habitacion = $_POST["id_habitacion"];
	$reserva->id_servicio = $_POST["id_servicio"];
	$reserva->id_cliente = $id_clientee;
	$reserva->total = $_POST["total"]; 
    $reserva->acuenta = $_POST["acuenta"]; 
	$reserva->fecha_entrada = $_POST["fecha_ingreso"].' '.$_POST['hora_ingreso'];
	
	$fecha_actual = $_POST["fecha_ingreso"];
    $fecha_salida = date("Y-m-d",strtotime($fecha_actual."+ 1 days")); 

	$reserva->fecha_salida =$fecha_salida.' '.$_POST['hora_ingreso'];
	$reserva->id_usuario = $_SESSION["user_id"];
	$reserva->id_caja = $id_caja;
	$f=$reserva->add();
	
	$id=$f[1];

 print "<script>window.location='index.php?view=imprimir_reserva&id=$id';</script>";


}else{
	 	
	 	echo "<script>alert('ALGO VA MAL');</script>";
	 	print "<script>window.location='index.php?view=reservap';</script>";

	 
}

?>