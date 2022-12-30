<?php

if(@count($_POST)>0){

	$cajas = CajaData::getAllAbierto(); 
 	if(@count($cajas)>0){ $id_caja=$cajas->id;
 	}else{$id_caja='NULL';}

	$gasto = new GastoData();
	$gasto->descripcion = $_POST["descripcion"];
	$gasto->precio = $_POST["precio"];
	$gasto->id_usuario = $_SESSION["user_id"];
	$gasto->fecha = $_POST["fecha"];
	$gasto->hora = $_POST["hora"];
	$gasto->id_caja = $id_caja;
	$gasto->id_tipopago = $_POST["id_tipopago"];
 	$s=$gasto->addIngreso(); 

 	$id=$s[1];
	
 
print "<script>alert('Ingreso registrado');</script>"; 
print "<script>window.location='index.php?view=imprimir_ingreso&id=$id';</script>";


};

?>