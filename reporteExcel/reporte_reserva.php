<?php
include "../core/autoload.php";
include "../core/app/model/ProcesoData.php";
include "../core/app/model/PersonaData.php";
include "../core/app/model/HabitacionData.php";
include "../core/app/model/PagoProcesoData.php";
include "../core/app/model/ProcesoVentaData.php";
include "../core/app/model/NivelData.php";
include "../core/app/model/CategoriaData.php";
include "../core/app/model/TarifaData.php";
include "../core/app/model/UserData.php";
include "../core/app/model/TarifaHabitacionData.php";
include "../core/app/model/ReservapData.php";
include "../core/app/model/SHreservaData.php";


set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
// PHPExcel
include 'Classes1/PHPExcel.php';
// PHPExcel_IOFactory
include 'Classes1/PHPExcel/IOFactory.php';
// Creamos un objeto PHPExcel
$objPHPExcel = new PHPExcel();
date_default_timezone_set('America/Guatemala');
$hoy = date("Y-m-d");
$hora = date("H:i:s");                   
$reportediarios = ReservapData::getIngresoRangoFechas($_GET['start'],$_GET['end']);
// Leemos un archivo Excel 2007
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
 
$objPHPExcel = $objReader->load("reporte_reserva.xlsx");

   

		$i = 9;
		foreach($reportediarios as $reportediario){ 
			
			$objPHPExcel->getActiveSheet(0)->getRowDimension(1)->setRowHeight(-1); 
			$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$i,  $_GET['start'].' - '.$_GET['end'])
				    ->setCellValue('B'.$i,  $reportediario->getPersona()->documento)
				    ->setCellValue('C'.$i,  $reportediario->getPersona()->nombre)
					->setCellValue('D'.$i,  $reportediario->getPersona()->estado_civil)
					->setCellValue('E'.$i,  $reportediario->getHabitacion()->nombre)
					->setCellValue('F'.$i,  $reportediario->getServicio()->nombre)
					->setCellValue('G'.$i,  $reportediario->total)
				    ->setCellValue('H'.$i,  $reportediario->fecha_entrada)
				    ->setCellValue('I'.$i,  $reportediario->getUsuario()->name);
					$i++;
					
		}  
		
 

//Guardamos el archivo en formato Excel 2007
//Si queremos trabajar con Excel 2003, basta cambiar el 'Excel2007' por 'Excel5' y el nombre del archivo de salida cambiar su formato por '.xls'
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Reporte_RESERVA.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	