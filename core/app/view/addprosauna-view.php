<?php

if(@count($_POST)>0){


	
	$producto = new ProductoData();
	$producto->codigo = $_POST["codigo"];
	$producto->nombre = $_POST["nombre"];

		
	$descripcion="NULL";
	if($_POST["descripcion"]!=""){ $descripcion=$_POST["descripcion"];}

	
	$producto->descripcion = $descripcion;
	$producto->precio_venta = $_POST["precio_venta"];
	$producto->id_categoriap = $_POST["id_categoriap"];
	$producto->addServicioSauna();

	$id=$_POST["id_categoriap"];

print "<script>window.location='index.php?view=c_productos&id=$id';</script>";


}


?>