<?php

if(@count($_POST)>0){

	$inventary = new InventaryBedData();
	
	$inventary->name = $_POST["name"];
	$inventary->quantity = $_POST["quantity"];
	$inventary->bed_id = $_POST["bed_id"];
	$inventary->descripcion = $_POST["descripcion"];
	$inventary->id_proveedor = $_POST["id_proveedor"];
	$inventary->precio = $_POST["precio"];
	$inventary->id_usuario = $_SESSION["user_id"];
	
	$inventary->addInServicio();

	$id=$_POST["bed_id"];
 
print "<script>window.location='index.php?view=c_inventario&id=$id';</script>";


}


?>