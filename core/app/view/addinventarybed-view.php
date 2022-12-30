<?php

if(@count($_POST)>0){

	$inventary = new InventaryBedData();
	
	$inventary->name = $_POST["name"];
	$inventary->quantity = $_POST["quantity"];
	$inventary->bed_id = $_POST["bed_id"];
	
	$inventary->add();

	$id=$_POST["bed_id"];
 
print "<script>window.location='index.php?view=inventary_bed&id=$id';</script>";


}


?>