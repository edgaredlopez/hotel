<?php

if(@count($_POST)>0){
	
	$shreserva = SHreservaData::getById($_POST["id_shreserva"]);
	$shreserva->nombre = $_POST["nombre"];
	$shreserva->tipo = $_POST["tipo"];
	$shreserva->update();

if(isset($_POST["servicio"]))
{	 
print "<script>window.location='index.php?view=re_servicio';</script>";
}
else
{	 
print "<script>window.location='index.php?view=re_habitacion';</script>";
}

}


?>