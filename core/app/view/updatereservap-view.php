<?php
$session_id= session_id(); 
ini_set('date.timezone','America/Lima'); 

if(@count($_POST)>0){

	$cajas = CajaData::getAllAbierto(); 
 	if(@count($cajas)>0){ $id_caja=$cajas->id;
 	}else{$id_caja='NULL';}
 

      $cliente = PersonaData::getById($_POST["id_persona"]);
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
      


 	
 
  

    $reserva = ReservapData::getById($_POST["id_reservap"]);
	$reserva->id_habitacion = $_POST["id_habitacion"];
	$reserva->id_servicio = $_POST["id_servicio"];
	$reserva->id_cliente = $_POST["id_persona"];
	$reserva->total = $_POST["total"]; 
    $reserva->acuenta = $_POST["acuenta"]; 
	$reserva->fecha_entrada = $_POST["fecha_ingreso"].' '.$_POST['hora_ingreso'];
	
	$fecha_actual = $_POST["fecha_ingreso"];
    $fecha_salida = date("Y-m-d",strtotime($fecha_actual."+ 1 days")); 

	$reserva->fecha_salida =$fecha_salida.' '.$_POST['hora_ingreso'];
	$reserva->id_usuario = $_SESSION["user_id"];
	$reserva->id_caja = $id_caja;
	$reserva->update();
	
	$id=$_POST["id_reservap"];

 print "<script>window.location='index.php?view=imprimir_reserva&id=$id';</script>";


}else{
	 	
	 	echo "<script>alert('ALGO VA MAL');</script>";
	 	print "<script>window.location='index.php?view=reservap';</script>";

	 
}

?>