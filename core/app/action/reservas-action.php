<?php 
header('Content-Type: application/json');
$base = new Database();
$pdo = $base->connect1();

$accion=(isset($_GET['accion']))?$_GET['accion']:'leer';

switch ($accion) {

 
	default:
		//selecciona los eventos del calendario
		$sentenciaSQL=$pdo->prepare("SELECT proceso.id as id,proceso.id_habitacion as resourceId, proceso.fecha_entrada as start, proceso.fecha_salida as end,persona.nombre as title,persona.documento as documento, persona.direccion as direccion, persona.estado_civil as estado_civil, persona.tipo_documento as tipo_documento, proceso.estado as estado,proceso.observacion as observacion,proceso.dinero_dejado as dinero_dejado from proceso inner join persona on persona.id=proceso.id_cliente WHERE  proceso.estado!=5");
		$sentenciaSQL->execute();

		$resultado= $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

		echo json_encode($resultado);
		break; 
}

?>