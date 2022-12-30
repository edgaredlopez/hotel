<?php

if(@count($_POST)>0){


	
	$producto = new CategoriaProData();
	$producto->nombre = $_POST["nombre"];

	$producto->add();

print "<script>window.location='index.php?view=categoriap';</script>";


}


?>