<?php

if(@count($_POST)>0){
	
	$tarifa = TirajeData::getById($_POST["id_tiraje"]);

	$tarifa->fecha = $_POST["fecha"];
	$tarifa->nro_res_f = $_POST["nro_res_f"];
	$tarifa->nro_res = $_POST["nro_res"];
	$tarifa->serie = $_POST["serie"];
	$tarifa->del = $_POST["del"];
	$tarifa->al = $_POST["al"];
	$tarifa->update();

	
print "<script>window.location='index.php?view=tiraje_comprobantes';</script>";


}


?>