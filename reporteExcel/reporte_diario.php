<?php
include "../core/autoload.php";
include "../core/app/model/ProcesoData.php";
include "../core/app/model/PersonaData.php";
include "../core/app/model/HabitacionData.php";
include "../core/app/model/PagoProcesoData.php";
include "../core/app/model/ProcesoVentaData.php";


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
$reportediarios = ProcesoData::getReporteDiario($hoy);
// Leemos un archivo Excel 2007
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
 
$objPHPExcel = $objReader->load("reporte_diario.xlsx");

  

		$i = 9;
		foreach($reportediarios as $reportediario){ 
			
			
			$subtotal=0;
			$tmps = PagoProcesoData::getAllProceso($reportediario->id); 
                foreach($tmps as $p):  
                    $subtotal=$subtotal+$p->monto; 
                endforeach; 
                        
            $subtotal_prod=0;
            $tmps_prods = ProcesoVentaData::getByAll($reportediario->id); 
                foreach($tmps_prods as $p_prod):  
                    $subtotal_prod=$subtotal_prod+($p_prod->precio*$p_prod->cantidad); 
                endforeach; 
                        
       
                        
			if($reportediario->id_tipo_pago=='1'){ $tipopago= "EFECTIVO";}elseif ($reportediario->id_tipo_pago=='2') {$tipopago= "TARJETA";}elseif ($reportediario->id_tipo_pago=='3') { $tipopago= "DEPÓSITO";}
			    
			 $total_hab= ($subtotal);
			 $total= ($subtotal+$subtotal_prod);
			
			$objPHPExcel->getActiveSheet(0)->getRowDimension(1)->setRowHeight(-1); 
			$objPHPExcel->setActiveSheetIndex(0)
	
				    ->setCellValue('B'.$i,  $reportediario->getCliente()->documento)
					->setCellValue('C'.$i,  $reportediario->getHabitacion()->nombre)
					->setCellValue('D'.$i,  $total_hab)
				    ->setCellValue('E'.$i,  $subtotal_prod)
				    ->setCellValue('F'.$i,  $total)
				    ->setCellValue('G'.$i,  $tipopago)
				    ->setCellValue('H'.$i,  $reportediario->nro_folio)
				    ->setCellValue('I'.$i,  $reportediario->fecha_entrada)
				    ->setCellValue('J'.$i,  $reportediario->fecha_salida);
				    
	

					$i++;
					
		}  
		
 

//Guardamos el archivo en formato Excel 2007
//Si queremos trabajar con Excel 2003, basta cambiar el 'Excel2007' por 'Excel5' y el nombre del archivo de salida cambiar su formato por '.xls'
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Reporte_diario.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	