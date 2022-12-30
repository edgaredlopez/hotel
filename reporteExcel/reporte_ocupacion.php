<?php
include "../core/autoload.php";
include "../core/app/model/ProcesoData.php";
include "../core/app/model/PersonaData.php";
include "../core/app/model/HabitacionData.php";


set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
// PHPExcel
include 'Classes1/PHPExcel.php';
// PHPExcel_IOFactory
include 'Classes1/PHPExcel/IOFactory.php';
// Creamos un objeto PHPExcel
$objPHPExcel = new PHPExcel();
date_default_timezone_set('America/Lima');
$hoy = date("Y-m-d");
$hora = date("H:i:s");                   
$reportediarios = ProcesoData::getIngresoRangoFechas($_GET['start'],$_GET['end']);
// Leemos un archivo Excel 2007
$objReader = PHPExcel_IOFactory::createReader('Excel2007'); 
 
$objPHPExcel = $objReader->load("reporte_ocupacion.xlsx");

   

		$i = 9;
		foreach($reportediarios as $reportediario){ 
			
			if($reportediario->id_tipo_pago=='1'){ $tipopago= "EFECTIVO";}elseif ($reportediario->id_tipo_pago=='2') {$tipopago= "TARJETA";}elseif ($reportediario->id_tipo_pago=='3') { $tipopago= "DEPÓSITO";}
			 $subtotal= ($reportediario->precio*$reportediario->cant_noche)+$reportediario->total+$reportediario->extra;
			 if($reportediario->observacion!='NULL' and $reportediario->observacion!=NULL ){ $tipo= $reportediario->observacion;}else{$tipo= "-----";}
			
			$objPHPExcel->getActiveSheet(0)->getRowDimension(1)->setRowHeight(-1); 
			$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('B'.$i,  $reportediario->getHabitacion()->nombre)
				    ->setCellValue('C'.$i,  $reportediario->getCliente()->documento)
				    ->setCellValue('D'.$i,  $reportediario->getCliente()->nombre)
				    ->setCellValue('E'.$i,  $tipopago)
				    ->setCellValue('F'.$i,  $tipo)
				    ->setCellValue('G'.$i,  $reportediario->cant_noche);
				    
	

					$i++;
					
		}  
		
 

//Guardamos el archivo en formato Excel 2007
//Si queremos trabajar con Excel 2003, basta cambiar el 'Excel2007' por 'Excel5' y el nombre del archivo de salida cambiar su formato por '.xls'
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Reporte_ocupacion.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	