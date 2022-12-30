<?php

if(@count($_POST)>0){
 
	$proceso = SueldoData::getById($_POST["id_pago"]);
	$proceso->id_usuario = $_POST['id_usuario'];
    $proceso->monto = $_POST['monto'];
    $proceso->dia_pago = $_POST['dia_pago'];
    $proceso->fecha_comienzo = $_POST['fecha_comienzo']; 

	$proceso->updateSueldo();
	

print "<script>window.location='index.php?view=sueldo';</script>";


}


?>