<?php
if(@count($_POST)>0){

	$shreserva = new SHreservaData();
	$shreserva->nombre = $_POST["nombre"];
	$shreserva->tipo = $_POST["tipo"];
    $shreserva->add();

  

if(isset($_POST["servicio"]))
{
print "<script>window.location='index.php?view=re_servicio';</script>";
}else
{
print "<script>window.location='index.php?view=re_habitacion';</script>";    
}


}

?>