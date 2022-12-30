<?php

if(@count($_POST)>0){

	$comprobante = new TipoComprobanteData();
	$comprobante->nombre = $_POST["nombre"];
	$comprobante->estado = $_POST["estado"];
	$comprobante->add();

print "<script>window.location='index.php?view=tipo_comprobante';</script>";


}


?>