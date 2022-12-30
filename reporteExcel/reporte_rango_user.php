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
$reportediarios = ProcesoData::getIngresoRangoFechasUser($_GET['start'],$_GET['end'],$_GET['id_usuario']);
// Leemos un archivo Excel 2007
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
 
$objPHPExcel = $objReader->load("reporte_rango.xlsx");

   

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
                
            $total_hab = $subtotal;
            $venta_total = $total_hab+$subtotal_prod;
			
			if($reportediario->id_tipo_pago=='1'){ $tipopago= "EFECTIVO";}elseif ($reportediario->id_tipo_pago=='2') {$tipopago= "TARJETA";}elseif ($reportediario->id_tipo_pago=='3') { $tipopago= "DEPÓSITO";}
			 $subtotal= ($reportediario->precio*$reportediario->cant_noche)+$reportediario->total;
			 
			 $turno="NULL";
			 if($reportediario->id_tarifa!='' and $reportediario->id_tarifa!='NULL' and $reportediario->id_tarifa!='0'){ $turno= $reportediario->getTarifa()->nombre; }else{ $turno= "NULL"; }
			
			
			$objPHPExcel->getActiveSheet(0)->getRowDimension(1)->setRowHeight(-1); 
			$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$i,  $_GET['start'].' - '.$_GET['end'])
				    ->setCellValue('B'.$i,  $reportediario->getCliente()->documento)
				    ->setCellValue('C'.$i,  $reportediario->getCliente()->nombre)
					->setCellValue('D'.$i,  $reportediario->getCliente()->giro)
					->setCellValue('E'.$i,  $reportediario->getCliente()->direccion)
					->setCellValue('F'.$i,  $reportediario->getCliente()->estado_civil)
					->setCellValue('G'.$i,  $reportediario->getHabitacion()->nombre)
					->setCellValue('H'.$i,  $reportediario->getHabitacion()->getCategoria()->nombre)
					->setCellValue('I'.$i,  $reportediario->getHabitacion()->getNivel()->nombre)
					->setCellValue('J'.$i,  $turno)
					->setCellValue('K'.$i,  '-')
					->setCellValue('L'.$i,  $reportediario->getUsuario()->name)
					->setCellValue('M'.$i,  $reportediario->getHabitacion()->descripcion)
					->setCellValue('N'.$i,  $reportediario->precio)
				    ->setCellValue('O'.$i,  $reportediario->cant_noche)
				    ->setCellValue('P'.$i,  $total_hab)
				    ->setCellValue('Q'.$i,  $subtotal_prod)
				    ->setCellValue('R'.$i,  $venta_total)
				    ->setCellValue('S'.$i,  $tipopago)
				    ->setCellValue('T'.$i,  $reportediario->nro_folio)
				    ->setCellValue('U'.$i,  $reportediario->fecha_entrada)
				    ->setCellValue('V'.$i,  $reportediario->fecha_salida);
					$i++;
					
		}  
		
 

//Guardamos el archivo en formato Excel 2007
//Si queremos trabajar con Excel 2003, basta cambiar el 'Excel2007' por 'Excel5' y el nombre del archivo de salida cambiar su formato por '.xls'
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Reporte_recepcionista.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	