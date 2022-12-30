<?php

if(@count($_POST)>0){
	
	$comprobante = TipoComprobanteData::getById($_POST["id_comprobante"]);
	$comprobante->nombre = $_POST["nombre"];
	$comprobante->estado = $_POST["estado"];
	$comprobante->update();



	 
print "<script>window.location='index.php?view=tipo_comprobante';</script>";


}


?>