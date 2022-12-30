<?php

if(@count($_POST)>0){

	$invetary = InventaryBedData::getById($_POST["id_inventary"]);
	$invetary->name = $_POST["name"];
	$invetary->quantity = $_POST["quantity"];
	

	$invetary->update();
	$id = $_POST["bed_id"];

print "<script>window.location='index.php?view=inventary_bed&id=$id';</script>";


}


?>