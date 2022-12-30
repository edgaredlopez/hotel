<?php

if(@count($_POST)>0){

	$esperado = EsperadoData::getAllMesAnio($_POST["mes"],$_POST["anio"]);
	if(count($esperado)>0){

	print "<script>alert('Esta fecha ya se agregó anteriormente');</script>";
	print "<script>window.location='index.php?view=esperado';</script>";

	}else{

		$nivel = new EsperadoData();
		$nivel->mes = $_POST["mes"];
		$nivel->anio = $_POST["anio"];
		$nivel->cantidad = $_POST["cantidad"];
		$nivel->add(); 
		print "<script>window.location='index.php?view=esperado';</script>";

	}

	

print "<script>window.location='index.php?view=esperado';</script>";


}


?>