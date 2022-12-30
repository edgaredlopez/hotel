<?php

if(@count($_POST)>0){
 
	$producto = ProductoData::getById($marca=$_POST["id_producto"]);

	$producto->nombre = $_POST["nombre"];
 
		
	  $descripcion="NULL";
	  if($_POST["descripcion"]!=""){ $descripcion=$_POST["descripcion"];}

	 
	$producto->descripcion = $descripcion;
	
	$producto->precio_venta = $_POST["precio_venta"];
	
	$producto->updateSauna();

$id=$_POST["id_categoriap"];
print "<script>window.location='index.php?view=c_productos&id=$id';</script>";

}


?>