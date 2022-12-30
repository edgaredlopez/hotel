<?php

if(@count($_POST)>0){

	$tarifa = new TirajeData();
	$tarifa->id_comprobante = $_POST["id_comprobante"];
	$tarifa->fecha = $_POST["fecha"];
	$tarifa->nro_res_f = $_POST["nro_res_f"];
	$tarifa->nro_res = $_POST["nro_res"];
	$tarifa->serie = $_POST["serie"];
	$tarifa->del = $_POST["del"];
	$tarifa->al = $_POST["al"];
	$tarifa->add();

print "<script>window.location='index.php?view=tiraje_comprobantes';</script>";

}

?>